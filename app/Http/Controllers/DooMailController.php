<?php

namespace App\Http\Controllers;

use App\Http\Requests\DooMailRequest;
use App\Mail\DooContact;
use App\Models\Doo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DooMailController extends Controller
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
    public function store(DooMailRequest $request)
    {
        //
        $validated = $request->validated();
        Mail::to('propelerzvizns@gmail.com')->send(new DooContact());
        return [$validated, 'message'=> 'E-mail je uspesno poslat!'];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doo  $doo
     * @return \Illuminate\Http\Response
     */
    public function show(Doo $doo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doo  $doo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doo $doo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doo  $doo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doo $doo)
    {
        //
    }
}
