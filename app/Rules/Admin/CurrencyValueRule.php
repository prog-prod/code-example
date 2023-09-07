<?php

namespace App\Rules\Admin;

use App\Enums\CurrencyEnum;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class CurrencyValueRule implements ValidationRule
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
        if (!in_array($value, CurrencyEnum::getValues())) {
            $fail('The :attribute field must be a valid currency value (' . CurrencyEnum::implode() . ')');
        }
    }
}
