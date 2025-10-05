<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PurchaseDetailResource;
use App\Models\PurchaseDetail;
use Illuminate\Http\Request;

class PurchaseDetailApiController extends Controller
{
    // GET all purchase details
    public function index()
    {
        return PurchaseDetailResource::collection(PurchaseDetail::with(['purchase', 'product'])->get());
    }

    // Store a new purchase detail
    public function store(Request $request)
    {
        $data = $request->validate([
            'purchase_id' => 'required|integer|exists:purchases,id',
            'product_id' => 'required|integer|exists:products,id',
            'qty' => 'required|integer|min:1',
            'unit_price' => 'required|numeric',
            'discPer' => 'nullable|numeric',
            'discAmount' => 'nullable|numeric',
        ]);

        $detail = PurchaseDetail::create($data);

        return new PurchaseDetailResource($detail->load(['purchase', 'product']));
    }

    // Show single purchase detail
    public function show(PurchaseDetail $purchaseDetail)
    {
        return new PurchaseDetailResource($purchaseDetail->load(['purchase', 'product']));
    }

    // Update purchase detail
    public function update(Request $request, PurchaseDetail $purchaseDetail)
    {
        $data = $request->validate([
            'purchase_id' => 'required|integer|exists:purchases,id',
            'product_id' => 'required|integer|exists:products,id',
            'qty' => 'required|integer|min:1',
            'unit_price' => 'required|numeric',
            'discPer' => 'nullable|numeric',
            'discAmount' => 'nullable|numeric',
        ]);

        $purchaseDetail->update($data);

        return new PurchaseDetailResource($purchaseDetail->load(['purchase', 'product']));
    }

    // Delete purchase detail
    public function destroy(PurchaseDetail $purchaseDetail)
    {
        $purchaseDetail->delete();

        return response()->json(['message' => 'Purchase detail deleted successfully']);
    }
}
