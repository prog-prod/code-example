<?php

namespace Tests\Feature\TestPages\Traits;

use App\Models\Slider;

trait BaseTrait
{
    protected function createSlider(): void
    {
        Slider::factory()->create();
    }
}
