<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CoaSub;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;


class CoaSubApiController extends Controller
{
    public function index()
    {
        $coaSubs = CoaSub::with(['coaMain'])->get();
        return response()->json([
            'status' => 'success',
            'data' => $coaSubs
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'coa_main_id' => 'required|exists:coa_mains,id',
            'status' => 'required|in:active,inactive',
        ]);

        return CoaSub::create($validated);
    }

    public function show(CoaSub $coaSub)
    {
        return $coaSub->load('coaMain');
    }

    public function update(Request $request, CoaSub $coaSub)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'coa_main_id' => 'required|exists:coa_mains,id',
            'status' => 'required|in:active,inactive',
        ]);

        $coaSub->update($validated);
        return $coaSub;
    }

    // Destroy Any Coa Sub Account Head
    public function destroy(CoaSub $coaSub): JsonResponse
    {
        try {
            if (!$coaSub) {
                return response()->json([
                    'success' => false,
                    'message' => 'Coa Sub Account not found',
                ], 404);
            }

            $coaSub->delete();

            return response()->json([
                'success' => true,
                'message' => 'Coa Sub Account deleted successfully',
            ], 200);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Coa Sub Account not found',
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete Coa Sub Account: ' . $e->getMessage(),
            ], 500);
        }
    }
    


}
