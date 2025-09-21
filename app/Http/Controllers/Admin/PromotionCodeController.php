<?php

namespace App\Http\Controllers\Admin;

use App\Handlers\PromotionCodeHandlers;
use App\Handlers\userHandlers;
use App\Http\Controllers\Controller;
use App\Http\Requests\PromotionCodeStoreRequest;
use App\Http\Requests\PromotionCodeUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PromotionCodeController extends Controller
{

    public function __construct(private PromotionCodeHandlers $promotionCodeHandlers, private userHandlers $userHandlers) {}

    public function index()
    {
        return view('admin.promotions-code.index');
    }


    public function store(PromotionCodeStoreRequest $request)
    {
        try {
            $this->promotionCodeHandlers->storePromoCode($request->validated());

            return response()->json([
                'status' => 200,
                'message' => 'Promotion code created successfully.',
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Failed to create promotion code. Please try again.',

            ]);
        }
    }

    public function fetchAllPromoCodes()
    {
        try {
            return $this->promotionCodeHandlers->fetchAllPromoCodes();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Failed to fetch promotion codes. Please try again.',
            ]);
        }
    }


    public function edit(string $id)
    {
        try {
            $promoCode = $this->promotionCodeHandlers->fetchPromoCode($id);
            return response()->json([
                'status' => 200,
                'promoCode' => $promoCode,
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Failed to fetch promotion code. Please try again.',
            ]);
        }
    }


    public function update(PromotionCodeUpdateRequest $request, string $id)
    {
        try {
            info($id);
            $this->promotionCodeHandlers->updatePromoCode($request->validated(), $id);
            return response()->json([
                'status' => 200,
                'message' => 'Promotion code updated successfully.',
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Failed to update promotion code. Please try again.',
            ]);
        }
    }


    public function destroy(string $id)
    {
        try {
            $this->promotionCodeHandlers->deletePromoCode($id);
            return response()->json([
                'status' => 200,
                'message' => 'Promotion code deleted successfully.',
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Failed to delete promotion code. Please try again.',
            ]);
        }
    }

    public function check(Request $request)
    {
        try {
            $promoCode =  $this->promotionCodeHandlers->checkPromoCode($request->promo_code);
            return response()->json([
                'status' => 200,
                'message' => 'Promo code accepted! Enjoy your ' . (int)$promoCode->discount_percentage . '% discount.',
                'id' => $promoCode->id,

            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Failed to check promotion code. Please try again.',
            ]);
        }
    }
}
