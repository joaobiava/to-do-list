<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CPF implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if($this->first_digit_match($value) or $this->second_digit_match($value)){
            $fail("me caguei");
        }
    }
    
    private function first_digit_match(string $value): bool{
        $sum = 0;

        for($i=0, $j=10; $i<9; $i++, $j--){
            $psum = $sum + ($value[$i] * $j);
        }
    }
}
