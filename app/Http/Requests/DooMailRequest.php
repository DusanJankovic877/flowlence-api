<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DooMailRequest extends FormRequest
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
            //
            'doo' => 'string',
            'checkedServices' => 'array',
            'people.option_text' => 'string|nullable',
            'founders.option_text' => 'string|nullable',
            'income.option_text' => 'string|nullable',
            'pdv.option_text' => 'string|nullable',
            'payment.option_text' => 'string|nullable',
            'client.option_text' => 'string|nullable',
            'cashRegister.option_text' => 'string|nullable',
            'eBanking.option_text' => 'string|nullable',
            'comment' => 'string|nullable',
            'email' => 'required|email',
            'totalSum'=> 'numeric',
            'checkedServicesSum' => 'numeric'
        ];
    }
}
