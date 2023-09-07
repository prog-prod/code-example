<?php

namespace App\View\Components;

use App\Enums\LocalesEnum;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class MultiLangFormControl extends Component
{

    public string $attributeName;
    public string $inputType;
    public string $formControlType;
    public array $locales;
    public ?Model $model;
    public ?array $textEditorConf;
    public ?string $label;
    public ?string $attributeLabel;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $attributeName,
        ?Model $model = null,
        string $formControlType = 'input',
        string $inputType = 'text',
        ?string $label = null,
        ?array $textEditorConf = null
    ) {
        $this->attributeName = $attributeName;
        $this->inputType = $inputType;
        $this->formControlType = $formControlType;
        $this->locales = LocalesEnum::cases();
        $this->model = $model;
        $this->label = $label;
        $this->textEditorConf = $textEditorConf;
        $this->attributeLabel = trim(str_replace(['_', '-'], ' ', ucfirst($attributeName)));
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.multi-lang-form-control');
    }
}
