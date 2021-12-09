<?php

namespace App\Http\Controllers;
use File;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
// use Tymon\JWTAuth\Contracts\Providers\Storage;

use Illuminate\Support\Facades\Storage;

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
        // $blog = json_decode(request('blog'));
        $this->validate($request,[
            'image' => 'required|image|mimes:jpeg,jpg',
            'image' => 'max:5000'
        ]);
        $image = request()->file('image');
        $image_name = $image->getClientOriginalName();
        $image_name = time().'_'.$image_name;
        $image->move(public_path('/images'), $image_name);
     
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
