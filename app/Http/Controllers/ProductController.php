<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Product::with(['sizes', 'images'])->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $request->validate([
            "name" => "required",
            "category_id" => "required",
            "price" => "required",
            "sizes" => "required|array",
            "sizes.*" => "required|integer",
            "discount" => "required|boolean"
        ]);
        $product = Product::create($request->all());
        $product->sizes()->sync($request->input("sizes"));
        if($request->input("discount")) {
            $product->update(['promotion_id' => 1]);
        }
        return Product::with(['sizes'])->where('id', '=', $product['id'])->first();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $product)
    {
        return Product::with(['sizes', 'images'])->where('id', '=', $product)->first();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $product)
    {
        $uProduct = Product::find($product);
        $uProduct->update($request->all());
        $uProduct->sizes()->sync($request->input('sizes'));
        return $uProduct;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $product)
    {
        return Product::destroy($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function category(string $categoryId)
    {
        $category = Category::find($categoryId);

        $special_product = Product::with(['images'])->where('id', '=', $category->special_product_id)->first();
        $products = Product::with(['images'])->where('category_id', '=', $categoryId)->where('id', '!=', $category->special_product_id)->where('promotion_id', '=', null)->get();
        return [
            'special_product' => $special_product,
            'products' => $products
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function promotion(string $categoryId)
    {
        // $category = Category::find($categoryId);

        // $special_product = Product::with(['images'])->where('id', '=', $category->special_product_id)->first();
        return Product::with(['images'])->where('category_id', '=', $categoryId)->where('promotion_id', '!=', null)->get();
        // return [
        //     'special_product' => $special_product,
        //     'products' => $products
        // ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function test(string $product)
    {
        return Product::with(['sizes', 'images'])->where('id', '=', $product)->first();
    }

    
}
