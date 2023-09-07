<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalcDeliveryCostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'cityRecipient' => 'required|string|max:255',
            'cartItems' => 'required|array',
            'cartItems.*.quantity' => 'required|integer',
            'cartItems.*.product' => 'required|exists:products,id',
        ];
    }
}
