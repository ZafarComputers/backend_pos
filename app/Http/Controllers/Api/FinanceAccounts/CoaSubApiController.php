<?php

namespace App\Http\Controllers\Api\FinanceAccounts;

use App\Http\Controllers\Controller;
use App\Models\CoaSub;
use App\Http\Resources\FinanceAccount\CoaSubResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CoaSubApiController extends Controller
{
    public function index(Request $request)
    {
        $query = CoaSub::with(['coaMain','coas']);

        if ($request->has('coa_main_id')) {
            $query->where('coa_main_id', $request->coa_main_id);
        }

        return CoaSubResource::collection($query->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'coa_main_id' => 'required|exists:coa_mains,id',
            'type' => 'nullable|string|max:50',
            'status' => 'required|in:active,inactive',
        ]);

        // 🧮 Auto-generate the `code`
        $mainId = $validated['coa_main_id'];

        // Get parent CoaMain to use its code prefix (if exists)
        $coaMain = \App\Models\CoaMain::find($mainId);

        // Find last CoaSub under this main
        $lastSub = \App\Models\CoaSub::where('coa_main_id', $mainId)
            ->orderByDesc('id')
            ->first();

        // Generate new code
        if ($lastSub && isset($lastSub->code)) {
            // Increment numeric code like 10301 → 10302
            $newCode = (int)$lastSub->code + 1;
        } else {
            // Start fresh, using main id prefix
            $newCode = (int)($coaMain->id . '01'); // e.g., main=10 → 1001
        }

        // Merge code into validated data
        $validated['code'] = $newCode;

        $coaSub = \App\Models\CoaSub::create($validated);

        return response()->json([
            'status' => true,
            'message' => 'CoaSub created successfully.',
            'data' => $coaSub,
        ], 201);
    }

    public function show(CoaSub $coaSub)
    {
        $coaSub->load(['coaMain','coas']);
        return new CoaSubResource($coaSub);
    }

    public function update(Request $request, CoaSub $coaSub)
    {
        $coaSub->update($request->only('code','title','type','status'));
        return new CoaSubResource($coaSub);
    }

    public function destroy(CoaSub $coaSub)
    {
        $coaSub->delete();
        return response()->json(['message' => 'CoaSub deleted successfully']);
    }
}
