<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class NovaPoshtaRefString implements ValidationRule
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
        if (preg_match('/^\d{8}-\d{4}-\d{4}-\d{4}-\d{12}$/', $value)) {
            $fail("The :attribute must follow the mask \"00000000-0000-0000-0000-000000000000\".");
        }
    }
}
