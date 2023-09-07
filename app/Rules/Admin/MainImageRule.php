<?php

namespace App\Rules\Admin;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MainImageRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $files = explode(',', $value);
        collect($files)->each(function ($filename) use ($attribute, $fail) {
            if (!is_null($filename) && !preg_match('/^.*\.[a-zA-Z]{3,4}$/', $filename)) {
                $fail('There is an error in ' . $attribute . ' field.');
            }
        });
    }
}
