<?php

namespace App\Facades;

use App\DTO\HeroSliderDTO;
use App\DTO\Slick\SlickAnimationDTO;
use Illuminate\Support\Facades\Facade;

/**
 * @method HeroSliderDTO getMainSlider()
 * @method array getSlides()
 * @method SlickAnimationDTO getDefaultAnimation()
 *
 * @see \App\Services\HeroSliderService
 */
class HeroSliderFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'slider';
    }
}
