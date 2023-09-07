<?php

namespace Tests\Feature\TestPages;

use Illuminate\Foundation\Testing\DatabaseTransactions;

class IndexPageTest extends TestPage
{
    use DatabaseTransactions;

    /**
     * A basic feature test example.
     */
    public function test_page_return_ok_status(): void
    {
        $response = $this->get(route('index'));
        $response->assertStatus(200);
    }
}
