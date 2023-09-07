<?php

namespace App\DTO;

use App\DTO\Slick\SlickAnimationDTO;
use App\DTO\Slick\SlickItemDTO;

class ActionBtnDTO
{
    public string $name;
    public string $to;
    public SlickAnimationDTO $animation;
    public array $params;

    public function __construct(SlickItemDTO $item, string $to, array $params = [])
    {
        $this->name = $item->text;
        $this->animation = $item->animation;
        $this->to = $to;
        $this->params = $params;
    }
}
