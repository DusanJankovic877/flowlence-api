<?php

namespace App\Http\Controllers;

use App\Models\QuestionOption;
use Illuminate\Http\Request;

class EntrepreneurFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $services = QuestionOption::where('question_id', 1)->get();
        $people = QuestionOption::where('question_id', 2)->get();
        $incomes =  QuestionOption::where('question_id', 3)->get();
        $extra_incomes =  QuestionOption::where('question_id', 4)->get();
        $pdvs =  QuestionOption::where('question_id', 5)->get();
        $payments =  QuestionOption::where('question_id', 6)->get();
        $clients =  QuestionOption::where('question_id', 7)->get();
        $cash_registers =  QuestionOption::where('question_id', 8)->get();
        $e_bankings =  QuestionOption::where('question_id', 9)->get();
        $form_data = ['services' => $services, 'people' =>  $people, 'incomes' => $incomes, 'extraIncomes' => $extra_incomes, 'pdvs' => $pdvs, 'payments' => $payments, 'clients' => $clients, 'cashRegisters' => $cash_registers, 'eBankings' => $e_bankings];

        return $form_data;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EntrepreneurForm  $entrepreneurForm
     * @return \Illuminate\Http\Response
     */
    public function show(QuestionOption $entrepreneurForm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EntrepreneurForm  $entrepreneurForm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QuestionOption $entrepreneurForm)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EntrepreneurForm  $entrepreneurForm
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuestionOption $entrepreneurForm)
    {
        //
    }
}
