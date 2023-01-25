<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BitcoinState>
 */
class BitcoinStateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $ask = rand(1000, 100000) / 10;
        $bid = $ask - 1;
        $mid = ($bid + $ask) / 2;

        return [
            'mid' => $mid,
            'bid' => $bid,
            'ask' => $ask,
            'last_price' => $ask + 5,
            'low' => $ask - 10,
            'high' => $ask - 12,
            'volume' => rand(10000, 99000) / 13,
            'valid_until' => Carbon::now(),
        ];
    }
}
