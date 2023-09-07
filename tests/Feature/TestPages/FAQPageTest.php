<?php

namespace Tests\Feature\TestPages;

use Illuminate\Foundation\Testing\DatabaseTransactions;

class FAQPageTest extends TestPage
{
    use DatabaseTransactions;

    /**
     * A basic feature test example.
     */
    public function test_page_return_ok_status(): void
    {
        $this->withoutExceptionHandling();
        $this->refreshApplicationWithLocale('en');
        $response = $this->get(route('faq'));

        $response->assertStatus(200);
    }
}
