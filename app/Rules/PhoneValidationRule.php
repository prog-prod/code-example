<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class PhoneValidationRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param string $attribute
     * @param mixed $value
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $cleanedValue = preg_replace('/[^0-9]/', '', $value);

        if (preg_match('/^\+380\d{9}$/', $cleanedValue)) {
            $fail("The :attribute must be a valid phone number");
        }
    }
}
