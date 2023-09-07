<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class BooleanSelect extends Component
{
    public string $label;
    public ?array $values;
    public ?Model $model;
    public string $attribute;

    /**
     * Create a new component instance.
     */
    public function __construct(string $attribute, string $label, array $values = null, $model = null)
    {
        $this->attribute = $attribute;
        $this->label = $label;
        $this->values = $values;
        $this->model = $model;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.boolean-select');
    }
}
