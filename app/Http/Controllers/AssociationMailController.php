<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssociationMailRequest;
use App\Mail\AssociationContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AssociationMailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AssociationMailRequest $request)
    {
        //
        $validated = $request->validated();
        Mail::to('propelerzvizns@gmail.com')->send(new AssociationContact());
        return [$validated, 'message'=> 'E-mail je uspesno poslat!'];
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