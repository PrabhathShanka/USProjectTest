<?php

namespace App\Services;

use App\Models\Assignment;
use Illuminate\Support\Facades\Log;

class AssignmentServices
{

    public function fetchQuery()
    {
        try {
            return Assignment::query();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    public function store($request, $promoCodeId)
    {
        try {
            $assignment = Assignment::create([
                'user_id' => auth()->id(),
                'title' => $request->title,
                'subject' => $request->subject,
                'description' => $request->description,
                'deadline' => $request->deadline,
                'contact_type' => $request->contact_type,
                'contact_info' => $request->contact_info,
                'promotion_code_id' => $promoCodeId,
                'status' => 'pending',
            ]);

            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    $assignment->attachments()->create([
                        'file_path' => $file->store('assignments'),
                    ]);
                }
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    public function getAssignmentById($id)
    {
        try {
            return Assignment::with('attachments')->findOrFail($id);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    public function destroy($id)
    {
        try {
            Assignment::findOrFail($id)->delete();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }
}
