<?php

namespace App\View\Components;

use App\Enums\OrderStatusEnum;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class OrderStatus extends Component
{
    public ?OrderStatusEnum $status = null;

    /**
     * Create a new component instance.
     */
    public function __construct(string $status)
    {
        $this->status = OrderStatusEnum::from($status);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.order-status');
    }
}
