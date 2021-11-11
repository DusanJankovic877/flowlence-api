<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class PriceListFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        //treba dodati validaciju podataka i ispisati greske

        if($request['name'] === "newEntrepreneur"){
            $form_data = ['data' => Question::where('title', 'new ent')->with('question_options', 'question_type')->get()];
            return $form_data;
        }elseif($request['name'] === 'alreadyEntrepreneur'){
            $form_data = ['data' => Question::where('title', 'already ent')->with('question_options', 'question_type')->get()];
            return $form_data;
        }elseif($request['name'] === "newDoo"){
            $form_data = ['data' => Question::where('title', 'new doo')->with('question_options', 'question_type')->get()];
            return $form_data;
        }elseif($request['name'] === "alreadyDoo"){
            $form_data = ['data' => Question::where('title', 'already doo')->with('question_options', 'question_type')->get()];
            return $form_data;
        }elseif($request['name'] === "newAssociation"){
            $form_data = ['data' => Question::where('title', 'new assoc')->with('question_options', 'question_type')->get()];
            return $form_data;
        }elseif($request['name'] === "alreadyAssociation"){
            $form_data = ['data' => Question::where('title', 'already assoc')->with('question_options', 'question_type')->get()];
            return $form_data;
        }else{return 'that does not exists';}

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getSelecetedData(Request $request)
    {
        return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EntrepreneurForm  $entrepreneurForm
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
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
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EntrepreneurForm  $entrepreneurForm
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
    }
}
