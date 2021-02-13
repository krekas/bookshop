<?php

namespace App\Rules;

use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Validation\Rule;

class NotSameAsOldPassword implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return Hash::check(auth()->user()->password, $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'New password cannot be the same as old password.';
    }
}