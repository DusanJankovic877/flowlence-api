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
        //
        // return $request->file('images');
        // $rules = [
        //     'images' => 'mimes:jpeg,png,bmp,tiff |max:4096'
        // ];
        // $this->validate($request,$rules);
        $this->validate($request,[
            'images.*' => 'required|image|mimes:jpg,jpeg,png,bmp|max:20000',
          
        ]);
        // $input_data = $request->all();
        // $validator = Validator::make(
        //     $input_data, [
        //         'image_file.*' => 'required|mimes:jpg,jpeg,png,bmp|max:20000'
        //     ]
        // );
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
           //  $path = storage_path('images/').$image_name;
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
            $path = storage_path('images/').$fileName;
            return Response::download($path);        

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        //
    }
}
