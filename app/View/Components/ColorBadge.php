<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ColorBadge extends Component
{
    public string $color;

    /**
     * Create a new component instance.
     */
    public function __construct(string $color = 'gray')
    {
        $this->color = $color;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.color-badge');
    }
}
