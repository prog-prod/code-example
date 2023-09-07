<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProductMain extends Component
{
    public int $isMain;

    /**
     * Create a new component instance.
     */
    public function __construct(int $isMain)
    {
        $this->isMain = $isMain;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.product-main');
    }
}
