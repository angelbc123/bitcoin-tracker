<?php

namespace Tests\Feature;

use App\Models\BitcoinState;
use App\Models\BitcoinSubscriber;
use App\Notifications\BitcoinSubscriberNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class BitcoinSubscriberTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_created()
    {
        $bitcoinSubscriber = BitcoinSubscriber::factory()->create();

        $this->assertDatabaseHas(
            BitcoinSubscriber::class,
            ['id' => $bitcoinSubscriber->id]
        );
    }

    public function test_it_created_via_post_request()
    {
        /** @var BitcoinSubscriber $bitcoinSubscriber */
        $bitcoinSubscriber = BitcoinSubscriber::factory()->make();

        $this->post(route('bitcoin-subscribers.store', [
            'email' => $bitcoinSubscriber->email,
            'amount_threshold' => $bitcoinSubscriber->amount_threshold,
        ]));

        $this->assertDatabaseHas(
            BitcoinSubscriber::class,
            ['email' => $bitcoinSubscriber->email]
        );
    }

    public function test_it_sends_subscriber_email()
    {
        Notification::fake();

        /** @var BitcoinSubscriber $bitcoinSubscriber */
        $bitcoinSubscriber = BitcoinSubscriber::factory()->create();

        $bitcoinSubscriber->notify(new BitcoinSubscriberNotification());

        Notification::assertSentTo($bitcoinSubscriber, BitcoinSubscriberNotification::class);
    }
}
