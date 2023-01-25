<?php

namespace App\Jobs;

use App\Models\BitcoinState;
use App\Models\BitcoinSubscriber;
use App\Notifications\BitcoinSubscriberNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class BitcoinSubscriberJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected BitcoinState $bitcoinState;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(BitcoinState $bitcoinState)
    {
        $this->bitcoinState = $bitcoinState;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        BitcoinSubscriber::query()
            ->where('amount_threshold', '>', $this->bitcoinState->last_price)
            ->chunk(100, function($bitcoinSubscribers) {
                Notification::send($bitcoinSubscribers, new BitcoinSubscriberNotification());
            });
    }
}
