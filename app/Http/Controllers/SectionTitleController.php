<?php

namespace App\Http\Controllers;

use App\Models\SectionTitle;
use Illuminate\Http\Request;

class SectionTitleController extends Controller
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SectionTitle  $sectionTitle
     * @return \Illuminate\Http\Response
     */
    public function show(SectionTitle $sectionTitle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SectionTitle  $sectionTitle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SectionTitle $sectionTitle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SectionTitle  $sectionTitle
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $section_title = SectionTitle::findOrFail($id);
        if($section_title){
            $section_title->delete();
        }
        return ['sectionTitle' => $section_title];
    }
    
    
    
}
