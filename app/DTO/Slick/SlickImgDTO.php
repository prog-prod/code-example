<?php

namespace App\DTO\Slick;

class SlickImgDTO
{
    public string $src;
    public SlickAnimationDTO $animation;

    public function __construct(string $src, SlickAnimationDTO $animation)
    {
        $this->src = $src;
        $this->animation = $animation;
    }
}
