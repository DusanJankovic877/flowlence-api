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
            'entrepreneurForm.people' => 'string',
            'entrepreneurForm.income' => 'string',
            'entrepreneurForm.incomeExtra' => 'string',
            'entrepreneurForm.pdv' => 'string',
            'entrepreneurForm.payment' => 'string',
            'entrepreneurForm.clients' => 'string',
            'entrepreneurForm.cashRegister' => 'string',
            'entrepreneurForm.eBanking' => 'string',
            'entrepreneurForm.comment' => 'string',
            'entrepreneurForm.email' => 'email|required'
        ];
    }
}
