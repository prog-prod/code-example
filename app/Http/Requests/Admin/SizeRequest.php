<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SizeRequest extends FormRequest
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
            'key' => 'required|max:255',
            'name_uk' => 'nullable|max:255',
            'name_en' => 'nullable|max:255',
            'category_id' => 'nullable|numeric|min:0',
            'value' => 'required|max:255',
        ];
    }
}
