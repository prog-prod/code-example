<?php

namespace App\Rules\Admin;

use App\Enums\GenderEnum;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class GenderValueRule implements ValidationRule
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
        if (!in_array($value, [...GenderEnum::getValues(), 0])) {
            $fail('The :attribute field (' . $value . ') must be a valid value (' . GenderEnum::implode() . ')');
        }
    }
}
