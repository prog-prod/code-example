<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class FormControl extends Component
{
    public string $attribute;
    public string $formControlType;
    public string $inputType;
    public bool $required;
    public bool $multiple;
    public string $value;
    public ?Model $model;
    public bool $readonly;
    public ?string $label;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $attribute,
        ?Model $model = null,
        ?string $label = null,
        bool $required = true,
        bool $readonly = false,
        bool $multiple = true,
        string $value = '',
        string $formControlType = 'input',
        string $inputType = 'text',
    ) {
        $this->attribute = $attribute;
        $this->formControlType = $formControlType;
        $this->inputType = $inputType;
        $this->label = $label;
        $this->required = $required;
        $this->readonly = $readonly;
        $this->multiple = $multiple;
        $this->value = $value;
        $this->model = $model;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form-control');
    }
}
