<?php

namespace App\Http\Controllers;

use App\Models\Post;
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
        // return $request;
        $this->validate($request,[
            'postTitle' => 'required|max:100|string|min:10',
            'sectionTitles.*.sectionTId' => 'required|integer|max:1',
            'sectionTitles.*.title' => 'required|string|max:100|min:10',
            'textareas.*.textareaId' => 'required|integer|max:2',
            'textareas.*.text' => 'required|string|max:500|min:100',
            'textareas.*.belongsTo' => 'required|integer|max:2',
            'images.*.name' => 'required|string|max:100',
            'images.*.imageId' => 'required|integer|max:1',
            'images.*.belongsTo' => 'required|integer|max:1',
        ],[
            'postTitle.max' => 'Maksimalno 100 karaktera',
            'textareas.max' => 'Maksimalno 500 karaktera',
            'textareas.min' => 'Minimalno 100 karaktera',
            'min' => 'Minimalno 10 karaktera',
            'integer' => 'Mora biti okrugao broj',
            'string' => 'Mora biti u vidu slova',
            'required' => 'Obavezno polje',
            // 'textareas.*.belongsTo.required' => 'Obavezno polje',
            // 'images.*.belongsTo.required' => 'Obavezno polje',
        ]);
       
        //
// return $request;
    //    json_decode(request('blog'));
    // $this->validate($request,[
  
    //             // 'images.file' => 'max:5000',
    //         'postTitle' => 'required|max:100|string',
    //         'sectionTitles.*.sectionTId' => 'required|integer|max:1',
    //         'sectionTitles.*.title' => 'required|string|max:100',
    //         'images.*.file' => 'required|image|mimes:jpeg,jpg',
    //         'images.*.imageId' => 'required|integer|max:1',
    //         'images.*.belongsTo' => 'required|integer|max:1',
    //         'textareas.*.textareaId' => 'required|integer|max:2',
    //         'textareas.*.text' => 'required|string|max:500',
    //         'textareas.*.belongsTo' => 'required|integer|max:2',

    //     ]);

//WIRKING FILE ARRAY SAVING TO LARAVEl
        // foreach ($request->file('images') as $image) {
           // return $image->belongsTo;
        //   return  $request->getName($image);
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
     
        // return $fileName;
        //
        // return $request;
        // $path = public_path('/images/1639049836_elena-putina-WuSzNJpys_4-unsplash.jpg');
        // if(!\file_exists($path)){
        //     return response()->json(['message' => 'Image not found.'], 404);
        // }else{
        //     $path = public_path('images/').$fileName;
        //     return Response::download($path);        

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
