<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'autoplay' => 'required|boolean',
            'lazyLoad' => 'required|string|max:255',
            'autoplay_speed' => 'nullable|integer',
            'speed' => 'required|integer',
            'pause_on_focus' => 'required|boolean',
            'pause_on_hover' => 'required|boolean',
            'infinite' => 'required|boolean',
            'arrows' => 'required|boolean',
            'dots' => 'required|boolean',
        ];
    }
}
