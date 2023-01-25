<?php

namespace Database\Seeders;

use App\Models\BitcoinState;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BitcoinStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        foreach(range(200,1) as $index) {
            $ask = rand(1000, 100000) / 10;
            $bid = $ask - 1;
            $mid = ($bid + $ask) / 2;

           BitcoinState::create([
               'mid' => $mid,
               'bid' => $bid,
               'ask' => $ask,
               'last_price' => $ask + 5,
               'low' => $ask - 10,
               'high' => $ask - 12,
               'volume' => rand(10000, 99000) / 13,
               'valid_until' => Carbon::now()->subDays($index),
           ]);
        }
    }
}
