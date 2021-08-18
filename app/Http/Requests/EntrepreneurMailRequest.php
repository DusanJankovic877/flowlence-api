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
            'checkedServices' => 'array',
            'people.title' => 'string|nullable',
            'income.title' => 'string|nullable',
            'incomeExtra.price' => 'numeric|nullable',
            'incomeExtra.title' => 'string|nullable',
            'pdv.title' => 'string|nullable',
            'payment.title' => 'string|nullable',
            'client.title' => 'string|nullable',
            'cashRegister.title' => 'string|nullable',
            'eBanking.title' => 'string|nullable',
            'comment' => 'string|nullable',
            'email' => 'required|email',
            'totalSum'=> 'numeric',
            'checkedServicesSum' => 'numeric'
        ];
    }
}
