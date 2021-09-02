<?php

namespace App\Http\Controllers;

use App\Models\QuestionOption;
use Illuminate\Http\Request;

class AssociationFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
   
        $new_assoc_option_text = QuestionOption::select('option_text')->findOrFail(31);
        $new_assoc_option_text2 = QuestionOption::select('option_text')->findOrFail(33);
        $new_assoc_option_assoc2 = QuestionOption::select('option_text')->findOrFail(23);
        // $a = $new_option_text->toString();
        $assoc_founders = QuestionOption::where('question_id', 14)->get();
        foreach($assoc_founders as $founder){
            if($founder->id == 42)$founder->option_text = $new_assoc_option_text['option_text'];
            if($founder->id == 43)$founder->option_text = $new_assoc_option_text2['option_text'];
        }
        $assoc_founders2 = QuestionOption::where('question_id', 15)->get();
        foreach($assoc_founders2 as $founder){
            if($founder->id == 44)$founder->option_text = $new_assoc_option_assoc2['option_text'];
        }
        $reg_assoc = QuestionOption::where('question_id', 16)->get();
        $incomes =  QuestionOption::where('question_id', 3)->get();
        $people = QuestionOption::where('question_id', 2)->get();
        $pdvs = QuestionOption::where('question_id', 17)->get();
        $payments =  QuestionOption::where('question_id', 12)->get();
        $cash_registers =  QuestionOption::where('question_id', 8)->get();
        $e_bankings =  QuestionOption::where('question_id', 13)->get();
        $form_data = [
            'assocFounders' => $assoc_founders, 
            'assocFounders2' => $assoc_founders2, 
            'regAssoc' => $reg_assoc,
            'incomes' => $incomes,
            'people' =>  $people, 
            'pdvs' => $pdvs, 
            'payments' => $payments, 
            'cashRegisters' => $cash_registers, 
            'eBankings' => $e_bankings
        ];
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
