<?php

namespace XLaravel\ValidationTrCitizenNumberExtend\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use XAdam\TrCitizenNumberValidation;

class TrCitizenNumber implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!self::passes($value)) {
            $fail('tr-citizen-number::validation.tr_citizen_number')->translate();
        }
    }

    public static function passes(mixed $value): bool
    {
        return (is_int($value) || is_string($value)) && TrCitizenNumberValidation::validate($value);
    }
}
