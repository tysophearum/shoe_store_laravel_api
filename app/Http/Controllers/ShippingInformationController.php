<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShippingInformationRequest;
use App\Http\Requests\UpdateShippingInformationRequest;
use App\Models\ShippingInformation;
use Illuminate\Http\Request;

class ShippingInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return ShippingInformation::where("user_id", $request->user->id)->first();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreShippingInformationRequest $request)
    {
        $request->merge([
            "user_id" => $request->user->id
        ]);

        $request->validate([
            "order_id" => "required|integer|unique:shipping_information,order_id",
            "user_id" => "required|integer",
            "firstName" => "required|string",
            "lastName" => "required|string",
            "address" => "required|string",
            "country" => "required|string",
            "state" => "required|string",
            "zip" => "required|string"
        ]);

        return ShippingInformation::create($request->all());
        // return response([
        //     "message" => "Shipping information already exist"
        // ], 401);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShippingInformationRequest $request)
    {
        $shippingInformation = ShippingInformation::where("user_id", $request->user->id)->first();
        $shippingInformation->update($request->all());
        return $shippingInformation;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StoreShippingInformationRequest $request)
    {
        return ShippingInformation::where("user_id", $request->user->id)->delete();
    }
}
