<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PostController extends Controller
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
        $request->validate([
            'postTitle' => 'required|string|max:100',
            'images.*.belongsTo' => 'required|integer',
            'images.*.data' => 'image64:jpeg,jpg,png|string',
            'images.*.name' => 'string|max:255',
            'images.*.size' => 'max:5000',
            'sectionTitles.*.belongsTo' => 'string|max:14',
            'sectionTitles.*.sectionTId' => 'integer',
            'sectionTitles.*.title' => 'required|string|max:100',
            'textareas.*.belongsTo' => 'integer',
            'textareas.*.text' => 'required|string|max:500',
            'textareas.*.textareaId' => 'integer',


        ]);
        // $imageData = $request->get('image');
        // $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
        return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
