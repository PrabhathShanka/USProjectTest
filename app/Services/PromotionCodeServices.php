<?php

namespace App\Services;

use App\Models\PromotionCode;
use Illuminate\Support\Facades\Log;

class PromotionCodeServices
{

    public function getAll()
    {
        try {
            return PromotionCode::all();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    public function getById($id)
    {
        try {
            return PromotionCode::find($id);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    public function store($validated)
    {
        try {
            PromotionCode::create($validated);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    public function update($validated, $id)
    {
        try {
            return PromotionCode::where('id', $id)->update($validated);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    public function destroy($id)
    {
        try {
            return PromotionCode::destroy($id);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    public function checkPromoCode($code){
        try {
            return PromotionCode::where('promo_code', $code)->whereIn('status', [1,2])->first();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    public function getPromoCodes(){
        try {
            return PromotionCode::select('id', 'promo_code', 'discount', 'status')->get();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }
}
