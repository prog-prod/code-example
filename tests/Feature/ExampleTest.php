<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $this->withoutExceptionHandling();
        $this->refreshApplicationWithLocale('en');
        $this->createSlider();
        $response = $this->get('/en/');
        $response->assertStatus(200);
    }

    public function test_the_application_not_found_response(): void
    {
        $this->withoutExceptionHandling();
        $this->refreshApplicationWithLocale('en');
        $response = $this->get('/products');
        $response->assertStatus(404);
    }
}
