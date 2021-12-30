<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Post;
use App\Models\SectionTitle;
use App\Models\Textarea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
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
        $posts = Post::all();
        $sorted_posts= [];
        foreach($posts as $post){
            $section_titles = SectionTitle::with('images')->where('post_id', $post['id'])->first();
            $sorted_posts[] = ['post_title' => $post, 'section_titles' => $section_titles];
        }
        return response()->json($sorted_posts);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    // public function show(Post $post)
    public function show($id)
    {
        $post_title = Post::findOrFail($id);
        $section_titles = SectionTitle::where('post_id', $post_title['id'])->with('images','textareas')->get();
        return response()->json([$post_title, 'section_titles' => $section_titles]);
    }
    public function edit($id)
    {
        $post_title = Post::findOrFail($id);
        $section_titles = SectionTitle::where('post_id', $post_title['id'])->with('images','textareas')->get();
        $images = [];
        foreach($section_titles as $section_title){
            $image = Image::where('section_title_id',  $section_title['id'])->get();
            $images[] = app('App\Http\Controllers\PrintReportController')->show($image['name']);;
            // app('App\Http\Controllers\PrintReportController')->show($image['name']);
            // return $image['name'];
            // $path = storage_path($image['path']).$image['name'];
          
            // return $path;
            // $real_image = Response::download($path);
            // $images[] = $real_image;
        }
        foreach($images as $image){
            return $image['name'];
        }
        // return $images;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        
        
        foreach($request['images_to_edit'] as $image_to_edit){
            $image_to_replace = $image_to_edit['imageToReplaceId'] ? Image::findOrFail($image_to_edit['imageToReplaceId']) : null;
            $path = $image_to_replace ? storage_path('images/').$image_to_replace['name'] : null;
            if($image_to_edit['imageToReplaceId'] === null && count($request['images_to_edit']) !== 0){
                Image::create([
                    'name' => $image_to_edit['imageName'],
                    'path' => 'images/',
                    'section_title_id' => $image_to_edit['sectionTitleId']
                ]);
                // return response()->json(['saved' => $image_to_save]);
            }else if(file_exists($path) && $image_to_edit['imageToReplaceId']){
                unlink($path);
                $image_to_replace->name = $image_to_edit['imageName'];
                $image_to_replace->save();
            }
        }
        $post_r =  $request['post'][0];
        
        $post = Post::findOrFail($post_r['id']);
        $section_titles_r = $request['post']['section_titles'];
        // return $section_titles_r;
        // return ['post' => $post_r['post_title'] === $post->post_title];
            if($post->post_title !== $post_r['post_title']){
                $post->post_title = $post_r['post_title'];
                $post->save();
                $s_titles = [];
                foreach($section_titles_r as $section_title_r){
                    $section_title = SectionTitle::findOrFail($section_title_r['id']);
                    if($section_title['title'] !== $section_title_r['title']){
                        $section_title->title = $section_title_r['title'];
                        $section_title->save();
                        $s_titles[] =$section_title;
                    }else {
                        //textarea
                    }
                }
                return['stitle' => $s_titles];
            }else{
                foreach($section_titles_r as $section_title_r){
                   $section_title = SectionTitle::findOrFail($section_title_r['id']);
                   if($section_title['title'] !== $section_title_r['title']){
                       $section_title->title = $section_title_r['title'];
                       $section_title->save();
                       $s_titles[] =$section_title;
                   }else {
                       //textarea
                   }
                }
                return['stitle' => $s_titles];

            }
       
        

        

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
