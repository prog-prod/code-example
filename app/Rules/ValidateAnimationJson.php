<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class ValidateAnimationJson implements ValidationRule
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
        $data = json_decode($value, true);

        if (!(array_key_exists('in', $data) &&
            array_key_exists('out', $data) &&
            array_key_exists('delayIn', $data) &&
            array_key_exists('delayOut', $data) &&
            array_key_exists('durationIn', $data) &&
            array_key_exists('durationOut', $data)
        )) {
            $fail(
                'The :attribute must be a valid JSON string containing the following keys: in, out, delayIn, delayOut, durationIn, durationOut.'
            );
        }
    }
}
