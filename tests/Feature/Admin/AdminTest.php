<?php

namespace Tests\Feature\Admin;

use App\Models\AdminUser;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic feature test example.
     */
    public function testLogoutRoute()
    {
        // Create a user and log them in
        $user = AdminUser::factory()->create();
        $this->actingAs($user, 'admin');

        // Send a POST request to the logout route
        $response = $this->post(route('admin.logout'));

        // Check that the response has a status code of 302, which indicates a redirect
        $response->assertStatus(302);

        // Check that the user is logged out
        $this->assertGuest();
    }
}
