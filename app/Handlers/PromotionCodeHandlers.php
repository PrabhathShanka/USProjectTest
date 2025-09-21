<?php

namespace App\Handlers;

use App\Models\PromotionCode;
use App\Services\PromotionCodeServices;
use Illuminate\Support\Facades\Log;

class PromotionCodeHandlers
{

    public function __construct(private PromotionCodeServices $promotionCodeServices) {}


    public function storePromoCode($validated)
    {
        try {
           // $validated['promo_code'] = $this->generateUniquePromoCode();
            $this->promotionCodeServices->store($validated);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    public function fetchAllPromoCodes()
    {
        try {
            return $this->generatePromCodeTable($this->promotionCodeServices->getAll());
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    public function fetchPromoCode($id){
        try{
            return $this->promotionCodeServices->getById($id);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }

    }

    public function deletePromoCode($id){
        try{
         return $this->promotionCodeServices->destroy($id);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    public function updatePromoCode($validated, $id){
        try{
            return $this->promotionCodeServices->update($validated, $id);
        }catch (\Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }

    }

    public function checkPromoCode($code){
        try{
            return $this->promotionCodeServices->checkPromoCode($code);
        }catch (\Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    public function generatePromCodeTable($promoCodes)
    {
        try {
            $response = '';
            if (count($promoCodes) > 0) {
                $response .= '<table id="myTable" class=" display min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Promotion Code</th>
                            <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Assigned To</th>
                            <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Discount</th>
                            <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Expiry Date</th>
                            <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">';

                foreach ($promoCodes as $promoCode) {
                    $response .= '
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">' . $promoCode->promo_code . '</td>
                                <td class="px-6 py-4 whitespace-nowrap">' . $promoCode->assigned_to . '</td>
                                <td class="px-6 py-4 whitespace-nowrap">' . number_format($promoCode->discount_percentage, 0) . '<strong> %</strong></td>
                                <td class="px-6 py-4 whitespace-nowrap">' . $promoCode->expiry_date . '</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    ' . ($promoCode->status == 1
                        ? '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>'
                        : ($promoCode->status == 0
                            ? '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-500 text-red-800">Inactive</span>'
                            : '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Expired</span>'
                        )
                    ) . '
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex space-x-2">
                                        <a href="#" id="' . $promoCode->id . '" class="promoCodeEdit text-indigo-600 hover:text-indigo-900 mr-3"><i class="fas fa-edit"></i></a>
                                        <a href="#" id="' . $promoCode->id . '" class="promoCodeDelete text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                        ';
                }

                $response .= '</tbody>
                </table>';
                return $response;
            } else {
                return '<h3 class="text-center">No data found</h3>';
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    // private function generateUniquePromoCode()
    // {
    //     do {
    //         $code = 'USPC' . rand(10000, 99999);
    //     } while (PromotionCode::where('promo_code', $code)->exists());

    //     return $code;
    // }
}
