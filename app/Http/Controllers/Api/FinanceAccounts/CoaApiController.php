<?php

namespace App\Http\Controllers\Api\FinanceAccounts;

use App\Http\Controllers\Controller;
use App\Models\Coa;
use App\Http\Resources\FinanceAccount\CoaResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CoaApiController extends Controller
{
    public function index(Request $request)
    {
        $query = Coa::with(['coaSub.coaMain']);

        if ($request->has('coa_sub_id')) {
            $query->where('coa_sub_id', $request->coa_sub_id);
        }

        return CoaResource::collection($query->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'coa_sub_id' => 'required|exists:coa_subs,id',
            // 'code', 'type', 'status' removed from required
        ]);

        $coaSub = \App\Models\CoaSub::findOrFail($validated['coa_sub_id']);

        // --------------------------
        // Auto-generate Code
        // --------------------------
        $lastCoa = \App\Models\Coa::where('coa_sub_id', $coaSub->id)
            ->orderByDesc('id')
            ->first();

        if ($lastCoa && isset($lastCoa->code)) {
            $newCode = (int)$lastCoa->code + 1;
        } else {
            // e.g., CoaSub code = 103 → first Coa = 10301
            $newCode = (int)($coaSub->code . '01');
        }

        // --------------------------
        // Default type & status
        // --------------------------
        $validated['code'] = $newCode;
        $validated['type'] = $coaSub->type ?? 'General';
        $validated['status'] = 'active';

        $coa = \App\Models\Coa::create($validated);

        return response()->json([
            'status' => true,
            'message' => 'Coa created successfully.',
            'data' => $coa,
        ], 201);
    }

    public function show(Coa $coa)
    {
        $coa->load(['coaSub.coaMain']);
        return new CoaResource($coa);
    }

    public function update(Request $request, Coa $coa)
    {
        $coa->update($request->only('code','title','type','status'));
        return new CoaResource($coa);
    }

    public function destroy(Coa $coa)
    {
        $coa->delete();
        return response()->json(['message' => 'Coa deleted successfully']);
    }
}
