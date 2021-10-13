<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\QuestionType;
use Illuminate\Http\Request;

class EntrepreneurFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        // return $request;
        // $result = QuestionType::with(['questions'])->get();
        if($request['name'] === "entrepreneur"){
        $form_data = [
            'services' => Question::where('id', 1)->with(['question_options', 'question_type'])->get(),
            'people' => Question::where('id', 2)->with(['question_options', 'question_type'])->get(),
            'incomes' => Question::where('id', 3)->with(['question_options', 'question_type'])->get(),
            'pdvs' => Question::where('id', 4)->with(['question_options', 'question_type'])->get(),
            'payments' => Question::where('id', 5)->with(['question_options', 'question_type'])->get(),
            'clients' => Question::where('id', 6)->with(['question_options', 'question_type'])->get(),
            'cash_registers' => Question::where('id', 7)->with(['question_options', 'question_type'])->get(),
            'e_bankings' => Question::where('id', 8)->with(['question_options', 'question_type'])->get(),
            'extra_incomes' => Question::where('id', 9)->with(['question_options', 'question_type'])->get()
        ];
            return $form_data;
        }elseif($request['name'] === "doo"){
            return 'doo';
        }elseif($request['name'] === "association"){return 'association';}
        // return $request;
        $questions = Question::with(['question_options', 'question_type'])->get();
       
    
        return $questions;
        $path = $request->validate(['path' => 'string']);
        if($path['path'] === '/price-list/entrepreneur'){

            $services = QuestionOption::where('question_id', 1)->get();
            $people = QuestionOption::where('question_id', 2)->get();
            $incomes =  QuestionOption::where('question_id', 3)->get();
            $extra_incomes =  QuestionOption::where('question_id', 4)->get();
            $pdvs =  QuestionOption::where('question_id', 5)->get();
            $payments =  QuestionOption::where('question_id', 6)->get();
            $clients =  QuestionOption::where('question_id', 7)->get();
            $cash_registers =  QuestionOption::where('question_id', 8)->get();
            $e_bankings =  QuestionOption::where('question_id', 9)->get();
            $form_data = ['services' => $services, 'people' =>  $people, 'incomes' => $incomes, 'extraIncomes' => $extra_incomes, 'item1' => $pdvs, 'item2' => $payments, 'clients' => $clients, 'cashRegisters' => $cash_registers, 'item3' => $e_bankings];
    
            return $form_data;
        }else if($path['path'] == '/price-list/doo'){
            $services = QuestionOption::where('question_id', 1)->get();
            $founders = QuestionOption::where('question_id', 10)->get();
            $people = QuestionOption::where('question_id', 2)->get();
            $incomes =  QuestionOption::where('question_id', 3)->get();
            $pdvs =  QuestionOption::where('question_id', 11)->get();
            $payments =  QuestionOption::where('question_id', 12)->get();
            $clients =  QuestionOption::where('question_id', 7)->get();
            $cash_registers =  QuestionOption::where('question_id', 8)->get();
            $e_bankings =  QuestionOption::where('question_id', 13)->get();
            $form_data = [
                'services' => $services, 
                'founders' => $founders, 
                'people' =>  $people, 
                'incomes' => $incomes,
                'item1' => $pdvs, 
                'item2' => $payments, 
                'clients' => $clients, 
                'cashRegisters' => $cash_registers, 
                'item3' => $e_bankings
            ];
            return $form_data;



        }

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
