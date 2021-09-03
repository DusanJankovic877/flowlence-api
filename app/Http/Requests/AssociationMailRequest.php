<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssociationMailRequest extends FormRequest
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
            'association' => 'string',
            'assocFounder.option_text' => 'string|nullable',
            'assocFounder2.option_text' => 'string|nullable',
            'registration.option_text' => 'string|nullable',
            'income.option_text' => 'string|nullable',
            'person.option_text' => 'string|nullable',
            'pdv.option_text' => 'string|nullable',
            'payment.option_text' => 'string|nullable',
            'cashRegister.option_text' => 'string|nullable',
            'eBanking.option_text' => 'string|nullable',
            'comment' => 'string|nullable',
            'email' => 'required|email',
            'totalSum'=> 'numeric',
        ];
    }
}
