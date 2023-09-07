<?php

namespace App\View\Components;

use App\Enums\PaymentStatusEnum;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PaymentStatus extends Component
{
    public ?PaymentStatusEnum $status = null;

    /**
     * Create a new component instance.
     */
    public function __construct(int $status = 0)
    {
        $this->status = PaymentStatusEnum::from($status);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.payment-status');
    }
}
