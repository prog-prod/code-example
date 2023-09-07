<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;

class DashboardTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $this->signInAsAdmin();

        $response = $this->get('/admin/dashboard');

        $response->assertStatus(200);
    }
}
