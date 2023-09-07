<?php

namespace App\DTO\Slick;

class SlickItemDTO
{
    public string $text;
    public SlickAnimationDTO $animation;

    public function __construct(string $text, SlickAnimationDTO $animation)
    {
        $this->text = $text;
        $this->animation = $animation;
    }
}
