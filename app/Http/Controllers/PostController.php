<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use File;
use App\Models\Post;
use Carbon\Carbon;
use Facade\FlareClient\Stacktrace\File as StacktraceFile;
use Faker\Provider\File as ProviderFile;
use Illuminate\Http\Request;
// use Tymon\JWTAuth\Contracts\Providers\Storage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
// use Illuminate\Support\Facades\Validator;

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
        // return $request['blog'];
    //    json_decode(request('blog'));
       
       request()->validate([
            'blog.postTitle' => 'required|max:100|string',
            'blog.sectionTitles.*.title' => 'required|string|max:100',
            'blog.sectionTitles.*.belongsTo' => 'required|integer|max:1',
            'blog.textareas.*.text' => 'required|string|max:500',
            'blog.textareas.*.belongsTo' => 'required|integer|max:1',

        ]);
        // $blog->validate([
        //     'blog.postTitle' => 'required'
        // ]);
        
        // return $blog;
        // $blog->validate([
        //     'postTitle' => 'required'
        // ]);
//WIRKING FILE ARRAY SAVING TO LARAVEl
        // foreach ($request->file('images') as $image) {
        // $image_name = $image->getClientOriginalName();
        // $image_name = time().'_'.$image_name;
        // $image->move(storage_path('images'), $image_name);
    // }

        
        // return $request;
        // $request =  json_decode($request['blog']);
    //  $request['postTitle']->validate([
    //      'postTitle' => 'required'
    //  ]);
        // return $request['blog']->validate([

            // 'postTitle' => 'required'
        // ]);
        // $rules = array(
        // );

    //  foreach(request('images') as $image){
    //      $realI = json_decode($image);
    //      return $realI;
        //  return $realI;
    //  }
        // return request();


        // $this->validate($request,[
        //     'image' => 'required|image|mimes:jpeg,jpg',
        //     'image' => 'max:5000'
        // ]);
        // $image = json_decode(request('images'));
    
        // $image = request()->file('image');
        // $image_name = $image->getClientOriginalName();
        // $image_name = time().'_'.$image_name;
        // $image->move(storage_path('images'), $image_name);


        
        // foreach($request['images'] as $image){
        //     return $image;
        // }
        // $blog = json_decode(request('blog'));
     
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    // public function show(Post $post)
    public function show($fileName)
    {
     
        // return 'sadasdsadasd';
        //
        // return $request;
        // $path = public_path('/images/1639049836_elena-putina-WuSzNJpys_4-unsplash.jpg');
        // if(!\file_exists($path)){
            // return response()->json(['message' => 'Image not found.'], 404);
        // }else{
            // return $fileName;
            // $path = public_path('images/').$fileName;
            // return Response::download($path);        
            // return \Response::download($filename);   
            // $contents = Storage::get(storage_path('images/').'1639136995_visual-stories-micheile-SoT4-mZhyhE-unsplash.jpg');
            // return $contents;
            // $image = Array('image' => json_encode(base64_encode($filename)));
            // $ads[0]->image = $image;
            // $type = \File::mimeType($path);
            // $response = \Response::make($file,200);
            // $response->header('Content-Type', $type);
            // return $filename;
        // }
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
