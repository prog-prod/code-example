<?php

namespace Tests\Feature\TestPages;

use Illuminate\Foundation\Testing\DatabaseTransactions;

class AboutPageTest extends TestPage
{

    use DatabaseTransactions;

    /**
     * A basic feature test example.
     */
    public function test_page_return_ok_status(): void
    {
        $this->refreshApplicationWithLocale('en');

        $response = $this->get(route('about'));

        $response->assertStatus(200);
    }

}
