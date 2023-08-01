<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Cart;
use App\Models\Item;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(StoreOrderRequest $request)
    {
        $user = $request->user;
        return Order::with(['items.product.images', 'paymentMethod', 'shippingInformation', 'shippingMethod'])->where('user_id', '=', $user->id)->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $cart = Cart::all()->where('user_id', '=', $request->user->id);
        $items = [];
        foreach ($cart as $c) {
            array_push($items, Item::find($c->item_id));
        }
        $price = 0;
        foreach ($items as $item) {
            $product = Product::find($item->product_id);
            $price = $price + ($product->price * $item->quantity);
        }

        $order = Order::create([
            'user_id' => $request->user->id,
            'price' => $price
        ]);

        foreach ($items as $item) {
            $item->update(['order_id' => $order->id]);
        }

        foreach ($cart as $c) {
            Cart::destroy($c->id);
        }

        return $order;
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
