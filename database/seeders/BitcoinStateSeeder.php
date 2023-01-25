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
            BitcoinState::factory()->create([
                'valid_until' => Carbon::now()->subDays($index),
            ]);
        }
    }
}
