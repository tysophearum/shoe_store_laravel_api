<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Cart;
use App\Models\Item;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Item::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemRequest $request)
    {
        $request->validate([
            "product_id" => "required|integer",
            "quantity" => "required|integer",
            "size_id" => "required|integer"
        ]);

        $item = Item::create($request->all());

        Cart::create([
            'user_id' => $request->user->id,
            'item_id' => $item->id
        ]);

        $product = Product::with(['images'])->where('id', '=', $item->product_id)->first();

        return [
            "id" => $item->id,
            "product_id" => $item->product_id,
            "size_id" => $item->size_id,
            "order_id" => $item->order_id,
            "quantity" => $item->quantity,
            "created_at" => $item->created_at,
            "updated_at" => $item->updated_at,
            "product" => $product
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = Item::find($id);
        $product = Product::with(['images'])->where('id', '=', $item->product_id)->first();
        return [
            "id" => $item->id,
            "product_id" => $item->product_id,
            "size_id" => $item->size_id,
            "order_id" => $item->order_id,
            "quantity" => $item->quantity,
            "created_at" => $item->created_at,
            "updated_at" => $item->updated_at,
            "product" => $product
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemRequest $request, string $id)
    {
        $request->validate([
            'quantity' => 'integer'
        ]);

        $item = Item::find($id);
        $item->update(['quantity' => $request->input('quantity')]);
        return $item;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Item::destroy($id);
    }
}
