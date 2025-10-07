<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CoaResource;
use App\Models\Coa;
use Illuminate\Http\Request;

class CoaApiController extends Controller
{
    /**
     * Display a listing of the Coa records.
     */
    public function index()
    {
        
         // ✅ Eager load relationships
        $coas = Coa::with(['coaSub.coaMain'])
            ->orderBy('id')
            ->get();

        // ✅ Return structured JSON
        return response()->json([
            'success' => true,
            'data' => CoaResource::collection($coas),
        ]);

    }

    /**
     * Store a newly created Coa record.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'coa_sub_id' => 'required|exists:coa_subs,id',
            'status' => 'required|in:Active,Inactive',
        ]);

        $coa = Coa::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Coa created successfully.',
            'data' => new CoaResource($coa->load('coaSub'))
        ], 201);
    }

    /**
     * Display a specific Coa record.
     */
    public function show($id)
    {
        $coa = Coa::with('coaSub.coaMain')->find($id);

        if (!$coa) {
            return response()->json([
                'success' => false,
                'message' => 'Coa not found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => new CoaResource($coa)
        ], 200);
    }

    /**
     * Update a specific Coa record.
     */
    public function update(Request $request, $id)
    {
        $coa = Coa::find($id);

        if (!$coa) {
            return response()->json([
                'success' => false,
                'message' => 'Coa not found.'
            ], 404);
        }

        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'coa_sub_id' => 'sometimes|exists:coa_subs,id',
            'status' => 'sometimes|in:Active,Inactive',
        ]);

        $coa->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Coa updated successfully.',
            'data' => new CoaResource($coa->load('coaSub'))
        ], 200);
    }

    /**
     * Remove a specific Coa record.
     */
    public function destroy($id)
    {
        $coa = Coa::find($id);

        if (!$coa) {
            return response()->json([
                'success' => false,
                'message' => 'Coa not found.'
            ], 404);
        }

        $coa->delete();

        return response()->json([
            'success' => true,
            'message' => 'Coa deleted successfully.'
        ], 200);
    }
}
