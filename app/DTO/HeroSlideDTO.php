<?php

namespace App\DTO;

use App\DTO\Slick\SlickImgDTO;
use App\DTO\Slick\SlickItemDTO;
use App\Http\Resources\ProductResource;

class HeroSlideDTO
{
    public SlickItemDTO $beforeTitle;
    public SlickItemDTO $title;
    public SlickItemDTO $afterTitle;
    public SlickItemDTO $desc;
    public ActionBtnDTO $actionBtn;
    public SlickImgDTO $img;
    public SlickItemDTO $bgLetter;
    public ?ProductResource $product;

    public function __construct(
        SlickItemDTO $beforeTitle,
        SlickItemDTO $title,
        SlickItemDTO $afterTitle,
        SlickItemDTO $desc,
        ActionBtnDTO $actionBtn,
        SlickImgDTO $img,
        SlickItemDTO $bgLetter,
        ?ProductResource $product = null
    ) {
        $this->beforeTitle = $beforeTitle;
        $this->title = $title;
        $this->afterTitle = $afterTitle;
        $this->desc = $desc;
        $this->actionBtn = $actionBtn;
        $this->img = $img;
        $this->bgLetter = $bgLetter;
        $this->product = $product;
    }
}
