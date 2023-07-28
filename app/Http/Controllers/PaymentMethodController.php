<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentMethodRequest;
use App\Http\Requests\UpdatePaymentMethodRequest;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return PaymentMethod::where("user_id", $request->user->id)->first();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentMethodRequest $request)
    {
        $request->merge([
            "user_id" => $request->user->id
        ]);

        $request->validate([
            "user_id" => "required|integer",
            "card_number" => "required|string",
            "name_on_card" => "required|string",
            "expire_date" => "required|string",
            "cvv" => "required|string",
        ]);

        return PaymentMethod::create($request->all());
        // return response([
        //     "message" => "Shipping information already exist"
        // ], 401);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentMethodRequest $request)
    {
        $paymentMethod = PaymentMethod::where("user_id", $request->user->id)->first();
        $paymentMethod->update($request->all());
        return $paymentMethod;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StorePaymentMethodRequest $request)
    {
        return PaymentMethod::where("user_id", $request->user->id)->delete();
    }
}
