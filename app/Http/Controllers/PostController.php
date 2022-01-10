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
        
        //response da bude posebno post title, posebno sekcije, posebno slike i posebno textarea-e
        $post_title = Post::findOrFail($id);
        $section_titles = SectionTitle::where('post_id', $post_title['id'])->get();
        $images = [];
        $count = 0;
        $textareas = [];
        foreach($section_titles as $section_title){
            $image = Image::where('section_title_id',  $section_title['id'])->first();
            // $images[] = $image;
            // return $image;
            if($image !== null){
                $count = $count++;
                $images[] = [
                    'formId' => $count,
                    'id' => $image->id,
                    'name' => $image->name,
                    'section_title_id' => $image->section_title_id,
                ];
           
            }
        
            $textarea = Textarea::where('section_title_id',  $section_title['id'])->get();
            $textareas = $textarea;
            // app('App\Http\Controllers\PrintReportController')->show($image['name']);
            // return $image['name'];
            // $path = storage_path($image['path']).$image['name'];
          
            // return $path;
            // $real_image = Response::download($path);
            // $images[] = $real_image;
        }
  
        // foreach($images as $image){
        //     return $image->name;
        //     $path = storage_path($image['path']).$image['name'];
        //     $real_image = Response::download($path);
        //     $images[] = $real_image;
        // }
        return ['post_title' => $post_title, 'section_titles' => $section_titles, 'images' => $images, 'textareas' => $textareas];
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
            if($post->post_title !== $post_r['post_title']){
                $post->post_title = $post_r['post_title'];
                $post->save();
                foreach($section_titles_r as $section_title_r){
                    $section_title = SectionTitle::findOrFail($section_title_r['id']);
                    if($section_title['title'] !== $section_title_r['title']){
                        $section_title->title = $section_title_r['title'];
                        $section_title->save();

                        foreach($section_title_r['textareas'] as $textarea_r){
                            $textarea = Textarea::findOrFail($textarea_r['id']);
                            if($textarea_r['text'] !== $textarea['text']){
                                $textarea['text'] = $textarea_r['text'];
                            }
                        }
                       
                    }else {
                        foreach($section_titles_r as $section_title_r){
                            foreach($section_title_r['textareas'] as $textarea_r){
                                $textarea = Textarea::findOrFail($textarea_r['id']);
                                if($textarea_r['text'] !== $textarea['text']){
                                    $textarea['text'] = $textarea_r['text'];
                                }
                            }
                        }
                    }
                }
            }else{
                foreach($section_titles_r as $section_title_r){
                   $section_title = SectionTitle::findOrFail($section_title_r['id']);
                   if($section_title['title'] !== $section_title_r['title']){
                       $section_title->title = $section_title_r['title'];
                       $section_title->save();

                       foreach($section_titles_r as $section_title_r){
                        foreach($section_title_r['textareas'] as $textarea_r){
                            $textarea = Textarea::findOrFail($textarea_r['id']);
                            if($textarea_r['text'] !== $textarea['text']){
                                $textarea['text'] = $textarea_r['text'];
                            }
                        }
                    }
                   }else {
                        foreach($section_titles_r as $section_title_r){
                            foreach($section_title_r['textareas'] as $textarea_r){
                                $textarea = Textarea::findOrFail($textarea_r['id']);
                                if($textarea_r['text'] !== $textarea['text']){
                                    $textarea['text'] = $textarea_r['text'];
                                    $textarea-> save();
                                }
                            }
                        }
                   }
                }

            }
            return response()->json(['message' => "Uspešno sačuvane promene"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::findOrFail($id);
        $section_titles = SectionTitle::where('post_id', $id)->get();
        // $images = [];
        
        foreach($section_titles as $section_title){
            foreach($section_title->images as $image){
                $path = storage_path('images/').$image->name;
                // $images[] = $image->name;
                if(file_exists($path)){
                    unlink($path);
                }
                $image_to_delete = Image::findOrFail($image->id);
                $image_to_delete->delete();
            }
            foreach($section_title->textareas as $textarea){
                $textarea_to_delete = Textarea::findOrFail($textarea->id);
                $textarea_to_delete->delete();
            }
            $section_title->delete();
        }
        $post->delete();
    // }else if(file_exists($path) && $image_to_edit['imageToReplaceId']){
    //     unlink($path);
    //     $image_to_replace->name = $image_to_edit['imageName'];
    //     $image_to_replace->save();
    // }
        return response()->json(['message' => 'Usepšno ste obrisali post']);
    }
}
