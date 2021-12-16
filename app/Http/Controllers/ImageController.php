<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Response;
use App\Models\Image;
use Illuminate\Http\Request;

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
        foreach ($request->file('images') as $image) {
            // return $image->belongsTo;
         //   return  $request->getName($image);
         $image_name = $image->getClientOriginalName();
         $image_name = time().'_'.$image_name;
         $image->move(storage_path('images'), $image_name);
           
         return response()->json(['image_name' => $image_name, 'image_path' => 'storage/images']);
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
