<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\Cart;
use App\Models\Item;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $cItems = Cart::where("user_id", $request->user->id)->get();
        $items = [];

        foreach ($cItems as $cItem) {
            
            $item = Item::find($cItem->item_id);
            $product = Product::with(['images'])->where('id', '=', $item->product_id)->first();

            array_push($items, [
                "id" => $item->id,
                "product_id" => $item->product_id,
                "size_id" => $item->size_id,
                "order_id" => $item->order_id,
                "quantity" => $item->quantity,
                "created_at" => $item->created_at,
                "updated_at" => $item->updated_at,
                "product" => $product
            ]);
        };

        return $items;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
