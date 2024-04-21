<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MalaysiaPhoneNumber implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
         if(!preg_match('/^(01)[0-9]{8}$/', $value)){
            $fail('Must be a valid Malaysia phone number.Example : 0169384763');
         }
    }
}
