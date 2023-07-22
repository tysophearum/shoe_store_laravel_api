<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBillingAddressRequest;
use App\Http\Requests\UpdateBillingAddressRequest;
use App\Models\BillingAddress;
use Illuminate\Http\Request;

class BillingAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return BillingAddress::where("user_id", $request->user->id)->first();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBillingAddressRequest $request)
    {
        $request->merge([
            "user_id" => $request->user->id
        ]);

        // $request->validate([
        //     "user_id" => "required|integer|unique:billing_addresses,user_id",
        //     "firstName" => "required|string",
        //     "lastName" => "required|string",
        //     "company" => "string",
        //     "address" => "required|string",
        //     "apt" => "string",
        //     "country" => "required|string",
        //     "state" => "required|string",
        //     "zip" => "required|string"
        // ]);

        return BillingAddress::create($request->all());
        // return response([
        //     "message" => "Shipping information already exist"
        // ], 401);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBillingAddressRequest $request)
    {
        $billingAddress = BillingAddress::where("user_id", $request->user->id)->first();
        $billingAddress->update($request->all());
        return $billingAddress;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StoreBillingAddressRequest $request)
    {
        return BillingAddress::where("user_id", $request->user->id)->delete();
    }
}
