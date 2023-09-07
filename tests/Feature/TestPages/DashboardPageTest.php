<?php

namespace Tests\Feature\TestPages;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class DashboardPageTest extends TestPage
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * A basic feature test example.
     */
    public function test_page_return_ok_status(): void
    {
        $this->refreshApplicationWithLocale('en');

        $user = \App\Models\User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $response = $this->actingAs($user)
            ->get(route('profile.dashboard.index'));

        $response->assertStatus(200);
    }

    public function test_dashboard_route_with_unverified_email()
    {
        $this->refreshApplicationWithLocale('en');
        $user = \App\Models\User::factory()->create([
            'email_verified_at' => null,
        ]);

        $response = $this->actingAs($user)
            ->get(route('profile.dashboard.index'));
        $response->assertRedirect(route('verification.notice'));
    }

    public function test_dashboard_route_with_non_auth_users()
    {
        $this->withoutExceptionHandling();
        $this->refreshApplicationWithLocale('en');
        $response = $this
            ->get(route('profile.dashboard.index'));
        $response->assertRedirect(route('login'));
    }
}
