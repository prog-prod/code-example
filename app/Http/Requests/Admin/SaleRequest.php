<?php

namespace App\Http\Requests\Admin;

use App\Rules\KeyRule;
use Illuminate\Foundation\Http\FormRequest;

class SaleRequest extends FormRequest
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
            'key' => ["required", "string", "max:255", new KeyRule()],
            'name_uk' => 'nullable|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'quantity' => 'required|integer|min:1',
            'percent' => 'required|numeric|between:1,100|max:100|min:1',
            'endDate' => 'required|date|after:today',
        ];
    }
}
