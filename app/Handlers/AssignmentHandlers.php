<?php

namespace App\Handlers;

use App\Models\Assignment;
use App\Services\AssignmentServices;
use App\Services\PromotionCodeServices;
use Illuminate\Support\Facades\Log;

class AssignmentHandlers
{
    public function __construct(private AssignmentServices $assignmentServices, private PromotionCodeServices $promotionCodeServices) {}

    public function index()
    {
        try {
            // Get base query from Service
            $query = $this->assignmentServices->fetchQuery()
                ->with('promotionCode')
                ->latest();

            // clone query for counts (without pagination)
            $total      = $query->count();
            $pending    = (clone $query)->where('status', 'pending')->count();
            $inProgress = (clone $query)->where('status', 'in_progress')->count();
            $completed  = (clone $query)->where('status', 'completed')->count();

            // Paginate results
            $assignments = $query->paginate(9);

            return [
                'assignments' => $assignments,
                'total'       => $total,
                'pending'     => $pending,
                'inProgress'  => $inProgress,
                'completed'   => $completed,
            ];
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    public function fetchAssignments($request)
    {
        try {
            $query = $this->assignmentServices->fetchQuery()
                ->with('promotionCode')
                ->latest();

            if ($request->status && $request->status !== 'all') {
                $query->where('status', $request->status);
            }

            if ($request->search) {
                $query->where('title', 'like', "%{$request->search}%");
            }

            $assignments = $query->paginate(9);

            return [
                'html' => view('components.assignment-grid', [
                    'assignments' => $assignments
                ])->render(),
                'pagination' => (string) $assignments->links()
            ];
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }


    public function store($request)
    {
        try {
            $promoCodeId = null;
            if ($request->filled('promo_code')) {
                $promoCode = $this->promotionCodeServices->checkPromoCode($request->promo_code);
                $promoCodeId = $promoCode->id;
            }
            $this->assignmentServices->store($request, $promoCodeId);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    public function show($id)
    {
        try {
            return $this->assignmentServices->getAssignmentById($id);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    public function destroy($id)
    {
        try {
            $this->assignmentServices->destroy($id);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }
}
