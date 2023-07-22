<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreImageRequest;
use App\Http\Requests\UpdateImageRequest;
use App\Models\Image;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreImageRequest $request)
    {
        $request->validate([
            'product_id' => 'required',
            'image' => 'required|image'
        ]);

        $input = $request->all();

        $productImage = new Image();
        $productImage->product_id = $request->input('product_id');

        if($request->hasFile('image')) {
            // Get the image file
            $image = $request->file('image');

            // Generate a unique filename for the image
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Store the image in the "public/images" directory
            $image->storeAs('public/images', $filename);

            $productImage->image_name = $filename;

            $productImage->image_path = asset('storage/images/' . $filename);
        }
        $productImage->save();

        return $productImage;
    }

    /**
     * Display the specified resource.
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateImageRequest $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image)
    {
        //
    }
}
