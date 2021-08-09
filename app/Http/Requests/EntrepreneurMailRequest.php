<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EntrepreneurMailRequest extends FormRequest
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
            'email' => 'required|email',
            'people' => 'string|nullable',
            'checkedServices' => 'array',
            'income' => 'string|nullable',
            'incomeExtra' => 'string|nullable',
            'pdv' => 'string|nullable',
            'payment' => 'string|nullable',
            'clients' => 'string|nullable',
            'cashRegister' => 'string|nullable',
            'eBanking' => 'string|nullable',
            'comment' => 'string|nullable'
        ];
    }
}
