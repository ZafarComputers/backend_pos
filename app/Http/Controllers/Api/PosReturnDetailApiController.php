<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PosReturnDetail;
use Illuminate\Http\Request;

class PosReturnDetailApiController extends Controller
{
    public function index()
    {
        return response()->json(PosReturnDetail::with(['posReturn', 'product'])->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pos_return_id'     => 'required|exists:pos_returns,id',
            'product_id'        => 'required|exists:products,id',
            'qty'               => 'required|integer|min:1',
            'return_unit_price' => 'required|numeric|min:0',
        ]);

        $detail = PosReturnDetail::create($validated);

        return response()->json($detail, 201);
    }

    public function show(PosReturnDetail $posReturnDetail)
    {
        return response()->json($posReturnDetail->load(['posReturn', 'product']));
    }

    public function update(Request $request, PosReturnDetail $posReturnDetail)
    {
        $validated = $request->validate([
            'pos_return_id'     => 'required|exists:pos_returns,id',
            'product_id'        => 'required|exists:products,id',
            'qty'               => 'required|integer|min:1',
            'return_unit_price' => 'required|numeric|min:0',
        ]);

        $posReturnDetail->update($validated);

        return response()->json($posReturnDetail);
    }

    public function destroy(PosReturnDetail $posReturnDetail)
    {
        $posReturnDetail->delete();
        return response()->json(null, 204);
    }
}
