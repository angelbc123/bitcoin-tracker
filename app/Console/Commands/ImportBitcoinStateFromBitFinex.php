<?php

namespace App\Console\Commands;

use App\Models\BitcoinState;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ImportBitcoinStateFromBitFinex extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bit-finex:import-bitcoin-state';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import BitcoinState from Bitfinex API';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $url = config('bit-finex.url');
        $response = Http::get($url);

        if($response->failed()) {
            Log::error($response);
            $this->info('BitcoinState importation has fail. Please check log file!');

            return Command::FAILURE;
        }

        $responseCollection = $response->collect();

        $bitcoinState = new BitcoinState();
        $bitcoinState->mid = $responseCollection->get('mid');
        $bitcoinState->bid = $responseCollection->get('bid');
        $bitcoinState->ask = $responseCollection->get('ask');
        $bitcoinState->last_price = $responseCollection->get('last_price');
        $bitcoinState->low = $responseCollection->get('low');
        $bitcoinState->high = $responseCollection->get('high');
        $bitcoinState->volume = $responseCollection->get('volume');
        $bitcoinState->valid_until = Carbon::createFromTimestamp($responseCollection->get('timestamp'));
        $bitcoinState->save();

        $this->info('BitcoinState was imported successfully!');
        return Command::SUCCESS;
    }
}
