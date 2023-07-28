<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Category::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        return Category::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $category)
    {
        return Category::find($category);
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, string $category)
    {
        $uCategory = Category::find($category);
        $uCategory->update($request->all());
        return $uCategory;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $category)
    {
        return Category::destroy($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function products(string $id)
    {
        return Category::with(['products.images'])->find($id);
    }
}
