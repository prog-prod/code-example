<?php

namespace App\Contracts;

use App\Models\Slider;

interface SliderRepositoryInterface
{
    public function getMainSlider(): Slider|null;
}
