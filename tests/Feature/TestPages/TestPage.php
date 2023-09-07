<?php

namespace Tests\Feature\TestPages;

use Tests\TestCase;

class TestPage extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
        $this->refreshApplicationWithLocale('en');
        $this->createSlider();
    }
}
