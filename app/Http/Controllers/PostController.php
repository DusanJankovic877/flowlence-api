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
        $section_titles = SectionTitle::where('post_id', $post_title['id'])->get();
        $s_titles = [];
        $images = [];
        $count = 0;
        $i_count = 0;
        $t_count = 0;
        $textareas = [];
        foreach($section_titles as $section_title){
            $count++;
            if($section_title !== null){
                $s_titles[] = [
                    'formId' => $count,
                    'id' => $section_title->id,
                    'title' => $section_title->title,
                    'post_id' => $section_title->post_id
                ];
            }
            $image = Image::where('section_title_id',  $section_title['id'])->get();
            foreach($image as $image_item){
                $i_count++;
                if($image_item !== null){
                    $images[] = [
                        'formId' => $i_count,
                        'id' => $image_item->id,
                        'name' => $image_item->name,
                        'section_title_id' => $image_item->section_title_id,
                        'oldName' => ''
                    ];
                }
            }
            $textarea = Textarea::where('section_title_id',  $section_title['id'])->get();
            foreach($textarea as $textarea_item){
                $t_count++;
                $textareas[] = 
                [
                    'formId' => $t_count,
                    'id' => $textarea_item->id,
                    'text' => $textarea_item->text,
                    'section_title_id' => $textarea_item->section_title_id
                ];
            }
        }
        return ['post_title' => $post_title, 'section_titles' => $s_titles, 'images' => $images, 'textareas' => $textareas];
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
        $validated = $this->validate($request,[
            'post.post_title.post_title' => 'max:100|string|min:10',
            // 'post.section_titles.*.id' => 'integer|max:100',
            'post.section_titles.*.title' => 'required|string|max:100|min:10',
            'post.textareas.*.id' => 'nullable|integer|max:140',
            'post.textareas.*.text' => 'required|string|max:1000|min:10',
            'post.textareas.*.section_title_id' => 'required|integer|max:140',
            'post.images.*.name' => 'string|max:100',
            'post.images.*.id' => 'integer|max:100',
            // 'post.images.*.section_title_id' => 'integer|max:100',
        ],[
            'postTitle.max' => 'Maksimalno 100 karaktera',
            'textareas.max' => 'Maksimalno 500 karaktera',
            'textareas.min' => 'Minimalno 100 karaktera',
            'min' => 'Minimalno 10 karaktera',
            'integer' => 'Mora biti okrugao broj',
            'string' => 'Mora biti u vidu slova',
            'required' => 'Obavezno polje',

            
        ]);
        $post_title_to_update =  Post::findOrFail($request['post']['post_title']['id']);
        if($post_title_to_update->post_title !== $request['post']['post_title']['post_title']){
            $post_title_to_update->post_title = $request['post']['post_title']['post_title'];
            $post_title_to_update->save();
        }

        foreach($request['post']['section_titles'] as $section_title){

            if($section_title['id'] === null){
               
               
               $section_to_save = SectionTitle::create([
                    'title' => $section_title['title'],
                    'post_id' => $post_title_to_update['id']
                ]);
                $section_to_save->save();
                //IMAGE
                foreach($request['post']['images'] as $image){
                    
                    if($image['id'] === null){
                        Image::create([
                            'name' => $image['name'],
                            'path' => 'images/',
                            'section_title_id' => $section_to_save['id']
                        ]);
                    }
                    elseif($image['oldName']){
                        
                        $image_to_replace = $image['oldName'] ? Image::where('name', $image['oldName'])->first() : null;
                        $path = $image_to_replace ? storage_path($image_to_replace->path).$image_to_replace['name'] : null;
                        if(file_exists($path)){
                            unlink($path);
                            $image_to_replace->name = $image['name'];
                            $image_to_replace->section_title_id = $image['section_title_id'];
                            $image_to_replace->save();
                        }
                    }
                }
                //TEXTAREA
                foreach($request['post']['textareas'] as $textarea){
                    
                    if($textarea['id'] === null){
                        Textarea::create([
                            'text' => $textarea['text'],
                            'section_title_id' => $section_to_save->id
                        ])->save(); 
                    }else{
                        $textarea_to_update = Textarea::findOrFail($textarea['id']);
                        $textarea_to_update->text = $textarea['text'];
                        $textarea_to_update->section_title_id = $textarea['section_title_id'];
                        $textarea_to_update->save();
                    }
                }
             
            }else{
                $section_title_to_update = SectionTitle::findOrfail($section_title['id']); 
                if($section_title_to_update['title'] !== $section_title['title']){
                    $section_title_to_update->title = $section_title['title'];
                    $section_title_to_update->save();
                }
                //IMAGE
                foreach($request['post']['images'] as $image){
                    if($image['id'] === null && $section_title_to_update->id === $image['section_title_id']){
                        Image::create([
                            'name' => $image['name'],
                            'path' => 'images/',
                            'section_title_id' => $image['section_title_id']
                        ]);
                    }elseif($image['id']){
                        $image_to_update = Image::findOrFail($image['id']);
                        $image_to_update->section_title_id = $image['section_title_id'];
                        if($image['oldName'] !== null){
                            $path = $image_to_update ? storage_path('images/').$image['oldName'] : null;
                            if(file_exists($path)){
                                unlink($path);
                                $image_to_update->name = $image['name'];
                            }
                        }
                        $image_to_update->save();
                    }
                }
                //TEXTAREA

                foreach($request['post']['textareas'] as $textarea ){
                    if($textarea['id'] === null && $section_title_to_update->id === $textarea['section_title_id']){
                        Textarea::create([
                            'text' => $textarea['text'],
                            'section_title_id' => $textarea['section_title_id']
                        ])->save(); 
                    }elseif($textarea['id']){
                        $textarea_to_update = Textarea::findOrFail($textarea['id']);
                        $textarea_to_update->text = $textarea['text'];
                        $textarea_to_update->section_title_id = $textarea['section_title_id'];
                        $textarea_to_update->save();
                    }
                }
            }
        }
        // $solo_section_titles= SectionTitle::where('post_id',$post_title_to_update->id)->get();
        
        $section_titles= SectionTitle::where('post_id',$post_title_to_update->id)->with('images', 'textareas')->get();
        // $images = [];
        // $textareas = [];
        // foreach($section_titles as $section_title){
        //     foreach($section_title->images as $image){
        //         $images[] = $image;
        //     }
        //     foreach($section_title->textareas as $textarea){
        //         $textareas[] = $textarea;
        //     }
        // }
        return response()->json([
                'message' => 'Promene na postu uspešno sačuvane', 
                'post' => ['post_title' => $post_title_to_update, 'section_titles' => $section_titles]
                          
        ]);
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
        $section_titles = SectionTitle::where('post_id', $id)->with('images')->get();
        foreach($section_titles as $section_title){
            foreach($section_title->images as $image){
                $path = storage_path('images/').$image->name;
                if(file_exists($path)){
                    unlink($path);
                }
            }

        }
        $post->delete();
        return response()->json(['message' => 'Usepšno ste obrisali post']);
    }
}
