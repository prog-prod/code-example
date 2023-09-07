<?php

namespace App\Repositories;

use App\Contracts\SliderRepositoryInterface;
use App\Models\Slider;

class SliderRepository implements SliderRepositoryInterface
{

    public function getMainSlider(): Slider|null
    {
        return Slider::where('name', 'main')->with('slides')->first();
    }
}
