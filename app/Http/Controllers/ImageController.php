<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Response;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
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
            'images.*' => 'image|mimes:jpg,jpeg,png|max:20000',
        ],[
            'image' => 'Mora biti slika',
            'mimes' => 'Mora biti formata: jpg, jpeg, png'
        ]);
        $images = array();
        foreach ($request->file('images') as $image) {
     
         $image_name = $image->getClientOriginalName();
         $image_name = time().'_'.$image_name;
         $image->move(storage_path('images'), $image_name);
         $path = storage_path('images/').$image_name;
         $images[] = $image_name;
        }
        if(!\file_exists($path)){
            return response()->json(['message' => 'Image not found.'], 404);
        }else{
            return response()->json(['images' => $images]);   
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show($fileName)
    {

        $path = storage_path('images/').$fileName;
        if(!\file_exists($path)){
            return response()->json(['message' => 'Image not found.'], 404);
        }else{
            $headers = array(
                "Content-Disposition: attachment; filename=\"" . basename($path) . "\"",
                "Content-Type: application/force-download",
                "Content-Length: " . filesize($path),
                "Connection: close"
            );
            return response()->download($path, $fileName, $headers);        

        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $this->validate($request,[
            'images.*' => 'image|mimes:jpg,jpeg,png|max:20000',
        ],[
            'image' => 'Mora biti slika',
            'mimes' => 'Mora biti formata: jpg, jpeg, png'
        ]);
        $images = array();
        foreach ($request->file('images') as $image) {
         $image_name = $image->getClientOriginalName();
         $image_name = time().'_'.$image_name;
         $image->move(storage_path('images'), $image_name);
         $path = storage_path('images/').$image_name;
         $images[] = $image_name;
        }
        if(!\file_exists($path)){
            return response()->json(['message' => 'Image not found.'], 404);
        }else{
            return response()->json(['images' => $images]);   
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $image = Image::findOrFail($id);
        $path = storage_path($image->path).$image->name;
        if(file_exists($path)){
            unlink($path);
            $image->delete();
            return response()->json(['message' => 'Slika uspešno obrisana']);
        }
    }
}
