<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class SmsTemplateIdRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($value == 0) {
            return;
        }

        if (!DB::table('sms_templates')->where('id', $value)->exists()) {
            $fail(
                'The :attribute must be 0 or an exists in sms templates.'
            );
        }
    }
}
