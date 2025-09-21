<?php

namespace App\Http\Controllers\Admin;

use App\Handlers\AssignmentHandlers;
use App\Http\Controllers\Controller;
use App\Http\Requests\AssignmentStoreRequest;
use App\Models\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Expr\Assign;

class AssignmentController extends Controller
{
    public function __construct(private AssignmentHandlers $assignmentHandlers) {}


    // AssignmentController.php
    public function index()
    {
        try {
            $assignments = $this->assignmentHandlers->index();
            return view('admin.assignments.index', compact('assignments'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Failed to fetch assignments. Please try again.',
            ]);
        }
    }

    public function fetchAssignments(Request $request)
    {
        try {
            $assignments = $this->assignmentHandlers->fetchAssignments($request);

            return response()->json([
                'status' => 200,
                'html' => $assignments['html'],
                'pagination' => $assignments['pagination']
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Failed to fetch assignments. Please try again.',
            ]);
        }
    }


    public function store(AssignmentStoreRequest $request)
    {
        try {
            $this->assignmentHandlers->store($request);

            return response()->json([
                'status' => 200,
                'message' => 'Assignment created successfully.',
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Failed to create assignment. Please try again.',
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
{
    try {
        $assignment = $this->assignmentHandlers->show($id);

        return view('admin.assignments.show', compact('assignment'));
    } catch (\Exception $e) {
        Log::error($e->getMessage());
        return response()->json([
            'status' => 500,
            'message' => 'Failed to fetch assignment. Please try again.',
        ]);
    }
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            info($id);
            $this->assignmentHandlers->destroy($id);
            return response()->json([
                'status' => 200,
                'message' => 'Assignment deleted successfully.',
            ]);
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Failed to delete assignment. Please try again.',
            ]);
        }
    }
}
