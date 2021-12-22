<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Post;
use App\Models\SectionTitle;
use App\Models\Textarea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

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
        $posts = Post::all();
        // $section_titles = [];
        $sorted_posts= [];
        foreach($posts as $post){
            // $section_titles = SectionTitle::where('post_id', $post['id'])->with('images', 'textareas')->get();
            
            $section_titles = SectionTitle::with('images')->where('post_id', $post['id'])->first();
            $sorted_posts[] = ['post_title' => $post, 'section_titles' => $section_titles];
            // return $section_titles;
        }
        return response()->json($sorted_posts);
        // return ['posts' => $posts, 'section_titles' => $section_titles];
        // return $post['id'];
        // $section_titles = SectionTitle::where('post_id', $post['id'])->with('images', 'textareas')->get();
        // foreach($section_titles as $section_title){
        //     foreach($section_title['images'] as $image){
        //         $path = storage_path($image['path']).$image['name'];
        //         if(!\file_exists($path)){
        //             return false;
        //         }else{
        //             $path = storage_path($image['path']).$image['name'];
        //             $image =  Response::download($path);
        //             // return $imagee;
        //         }
        //     }
        // }
        // return ['posts' => $post,'section_titles' => $section_titles];
        // return $post;

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
        $validated = $this->validate($request,[
            'postTitle' => 'required|max:100|string|min:10',
            'sectionTitles.*.sectionTId' => 'required|integer|max:10',
            'sectionTitles.*.title' => 'required|string|max:100|min:10',
            'textareas.*.textareaId' => 'required|integer|max:40',
            'textareas.*.text' => 'required|string|max:1000|min:10',
            'textareas.*.belongsTo' => 'required|integer|max:40',
            'images.*.name' => 'required|string|max:100',
            'images.*.imageId' => 'required|integer|max:10',
            'images.*.belongsTo' => 'required|integer|max:10',
        ],[
            'postTitle.max' => 'Maksimalno 100 karaktera',
            'textareas.max' => 'Maksimalno 500 karaktera',
            'textareas.min' => 'Minimalno 100 karaktera',
            'min' => 'Minimalno 10 karaktera',
            'integer' => 'Mora biti okrugao broj',
            'string' => 'Mora biti u vidu slova',
            'required' => 'Obavezno polje',
        ]);
       
        //
        $post_title = Post::create([
            'post_title' => $validated['postTitle'],
        ]);
        $post_title->save();
        foreach($validated['sectionTitles'] as $section_title){
       
            $to_save_section_title = SectionTitle::create([
                'title' => $section_title['title'],
                'post_id' => $post_title->id
            ]);
            $to_save_section_title->save();
            foreach($validated['images'] as $image){
            
                if($section_title['sectionTId'] === $image['belongsTo']){
                    Image::create([
                        'name' => $image['name'],
                        'path' => 'images/',
                        'section_title_id' => $to_save_section_title->id
                    ])->save(); 
                }
                
            }
            foreach($validated['textareas'] as $textarea){
                if($section_title['sectionTId'] === $textarea['belongsTo']){
    
                    Textarea::create([
                        'text' => $textarea['text'],
                        'section_title_id' => $to_save_section_title->id
                    ])->save();
                }
            }
        }
        
return response()->json(['message' => 'Uspešno sačuvan blog post'], 200);
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
