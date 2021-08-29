<?php

namespace App\Http\Controllers;

use App\Models\EntrepreneurForm;
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
        $services = EntrepreneurForm::where('form_id', 1)->get();
        $people = EntrepreneurForm::where('form_id', 2)->get();
        $incomes =  EntrepreneurForm::where('form_id', 3)->get();
        $extra_incomes =  EntrepreneurForm::where('form_id', 4)->get();
        $pdvs =  EntrepreneurForm::where('form_id', 5)->get();
        $payments =  EntrepreneurForm::where('form_id', 6)->get();
        $clients =  EntrepreneurForm::where('form_id', 7)->get();
        $cash_registers =  EntrepreneurForm::where('form_id', 8)->get();
        $e_bankings =  EntrepreneurForm::where('form_id', 9)->get();
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
    public function show(EntrepreneurForm $entrepreneurForm)
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
    public function update(Request $request, EntrepreneurForm $entrepreneurForm)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EntrepreneurForm  $entrepreneurForm
     * @return \Illuminate\Http\Response
     */
    public function destroy(EntrepreneurForm $entrepreneurForm)
    {
        //
    }
}
