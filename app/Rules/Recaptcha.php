<?php

namespace App\Rules;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Http;
use Zttp\Zttp;
class Recaptcha implements Rule
{
    const URL = 'https://www.google.com/recaptcha/api/siteverify';
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
        //
        
        return Zttp::asFormParams()->post('https://www.google.com/recaptcha/api/siteverify',[
            'secret' => '6LftPCIdAAAAAPD5Md-fahgg3sj0SCUhV9qC5e9B',
            'response' => $value,
        ]);

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
