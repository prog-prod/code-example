<?php

namespace App\Http\Requests\Api;

use App\Rules\NovaPoshtaRefString;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SearchStreetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'street' => 'string|required|max:255',
            'cityRef' => ['string', 'required', 'max:255', new NovaPoshtaRefString()]
        ];
    }
}
