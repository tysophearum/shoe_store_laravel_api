<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePromoCodeRequest;
use App\Http\Requests\UpdatePromoCodeRequest;
use App\Models\PromoCode;
use Carbon\Carbon;

class PromoCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PromoCode::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePromoCodeRequest $request)
    {
        $request->validate([
            'code' => 'string|required',
            'discount' => 'string|required',
            'expire_date' => 'required|date_format:d/m/Y'
        ]);

        $fields = $request->all();
        return PromoCode::create([
            'code' => $fields['code'],
            'discount' => $fields['discount'],
            'expire_date' => Carbon::createFromFormat('d/m/Y', $fields['expire_date'])
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePromoCodeRequest $request, string $id)
    {
        $promoCode = PromoCode::find($id);
        $promoCode->update($request->all());
        return $promoCode;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return PromoCode::destroy($id);
    }
}
