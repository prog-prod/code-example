<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ColorRequest extends FormRequest
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
     * @return array<string, Rule|array|string>
     */
    public function rules(): array
    {
        $color = $this->route('color');
        $colorId = $color ? $color->id : null;
        return [
            'key' => "required|unique:colors,key,$colorId",
            'name_uk' => 'nullable|string',
            'name_en' => 'nullable|string',
            'hex_code' => "required|unique:colors,hex_code,$colorId",
        ];
    }
}
