<?php

namespace App\Http\Requests;

use App\Enums\SexEnum;
use App\Models\User;
use App\Rules\PhoneValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string', 'max:255'],
            'first_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'zip' => ['nullable', 'string', 'max:10'],
            'sex' => ['nullable', 'numeric', Rule::in(SexEnum::getValues())],
            'birthday' => ['nullable', 'date'],
            'avatar' => ['nullable', 'image'],
            'phone' => ['nullable', new PhoneValidationRule],
            'country_code' => ['nullable', 'string', 'exists:countries,code'],
            'email' => ['required', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
        ];
    }
}
