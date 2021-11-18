<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PriceListMailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'typeOfFrom' => 'string',
            'firstQuestion' => 'array',
            'secondQuestion.option_text' => 'string|nullable',
            'thirdQuestion.option_text' => 'string|nullable',
            'fourthQuestion.price' => 'numeric|nullable',
            'fourthQuestion.option_text' => 'string|nullable',
            'fifthQuestion.option_text' => 'string|nullable',
            'sixthQuestion.option_text' => 'string|nullable',
            'seventhQuestion.option_text' => 'string|nullable',
            'eighthQuestion.option_text' => 'string|nullable',
            'ninthQuestion.option_text' => 'string|nullable',
            'comment' => 'string|nullable',
            'email' => 'required|email',
            'totalPrice'=> 'numeric',
            'firstQSum' => 'numeric'
        ];
    }
}
