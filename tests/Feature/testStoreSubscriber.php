<?php

namespace Tests\Feature;

use App\Models\Subscriber;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class testStoreSubscriber extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_subscribe_new_user(): void
    {
        $data = [
            'email' => fake()->unique()->safeEmail,
        ];

        $response = $this->post(route('subscribers.store'), $data);

        $response->assertOk();
        $this->assertDatabaseHas('subscribers', $data);
    }

    /**
     * A basic feature test example.
     */
    public function testSubscribeSubscriberAlreadyExists()
    {
        $subscriber = Subscriber::factory()->create([
            'email' => 'test@example.com',
        ]);

        $response = $this->post(route('subscribers.store'), [
            'email' => $subscriber->email,
        ]);
        $response->assertJsonValidationErrors(['email']);
        $response->assertStatus(302);
        $response->assertJsonFragment([
            'email' => ['You have already subscribed to our newsletter.']
        ]);
    }
}
