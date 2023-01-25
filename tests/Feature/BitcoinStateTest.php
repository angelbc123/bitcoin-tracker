<?php

namespace Tests\Feature;

use App\Models\BitcoinState;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BitcoinStateTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_created()
    {
        $bitcoinState = BitcoinState::factory()->create();

        $this->assertDatabaseHas(
            BitcoinState::class,
            ['id' => $bitcoinState->id]
        );
    }

    public function test_index_route_status()
    {
        $bitcoinState = BitcoinState::factory()->create();

        $response = $this->get(route('bitcoin-states.index'));
        $response->assertStatus(200);
    }
}
