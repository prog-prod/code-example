<?php

namespace App\DTO;

class HeroSliderDTO
{
    public int $id;
    public string $name;
    public bool $autoplay;
    public string $lazyLoad;
    public ?int $autoplay_speed;
    public int $speed;
    public bool $pause_on_focus;
    public bool $pause_on_hover;
    public bool $infinite;
    public bool $arrows;
    public bool $dots;
    public array $slides;

    public function __construct(array $attributes, array $slides)
    {
        $this->id = $attributes['id'];
        $this->name = $attributes['name'];
        $this->autoplay = (bool)$attributes['autoplay'];
        $this->lazyLoad = $attributes['lazyLoad'];
        $this->autoplay_speed = $attributes['autoplay_speed'] ? (int)$attributes['autoplay_speed'] : null;
        $this->speed = (int)$attributes['speed'];
        $this->pause_on_focus = (bool)$attributes['pause_on_focus'];
        $this->pause_on_hover = (bool)$attributes['pause_on_hover'];
        $this->infinite = (bool)$attributes['infinite'];
        $this->arrows = (bool)$attributes['arrows'];
        $this->dots = (bool)$attributes['dots'];
        $this->slides = $slides;
    }
}
