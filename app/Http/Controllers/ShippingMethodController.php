<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShippingMethodRequest;
use App\Http\Requests\UpdateShippingMethodRequest;
use App\Models\ShippingMethod;

class ShippingMethodController extends Controller
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
    public function store(StoreShippingMethodRequest $request)
    {
        $request->merge([
            "user_id" => $request->user->id
        ]);

        $request->validate([
            "name" => "required|string",
            "price" => "required|numeric"
        ]);

        return ShippingMethod::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(ShippingMethod $shippingMethod)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ShippingMethod $shippingMethod)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShippingMethodRequest $request, ShippingMethod $shippingMethod)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShippingMethod $shippingMethod)
    {
        //
    }
}
