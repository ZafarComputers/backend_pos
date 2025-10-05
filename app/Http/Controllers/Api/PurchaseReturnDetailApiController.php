<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PurchaseReturnDetail;
use App\Http\Resources\PurchaseReturnDetailResource;
use Illuminate\Http\Request;

class PurchaseReturnDetailApiController extends Controller
{
    public function index()
    {
        return PurchaseReturnDetailResource::collection(
            PurchaseReturnDetail::with(['purchaseReturn','product'])->get()
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'purchase_return_id' => 'required|exists:purchase_returns,id',
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|numeric',
            'unit_price' => 'required|numeric',
            'discPer' => 'nullable|numeric',
            'discAmount' => 'nullable|numeric',
        ]);

        $detail = PurchaseReturnDetail::create($data);

        return new PurchaseReturnDetailResource($detail);
    }

    public function show(PurchaseReturnDetail $purchaseReturnDetail)
    {
        return new PurchaseReturnDetailResource($purchaseReturnDetail->load(['purchaseReturn','product']));
    }

    public function update(Request $request, PurchaseReturnDetail $purchaseReturnDetail)
    {
        $data = $request->validate([
            'purchase_return_id' => 'sometimes|exists:purchase_returns,id',
            'product_id' => 'sometimes|exists:products,id',
            'qty' => 'sometimes|numeric',
            'unit_price' => 'sometimes|numeric',
            'discPer' => 'nullable|numeric',
            'discAmount' => 'nullable|numeric',
        ]);

        $purchaseReturnDetail->update($data);

        return new PurchaseReturnDetailResource($purchaseReturnDetail);
    }

    public function destroy(PurchaseReturnDetail $purchaseReturnDetail)
    {
        $purchaseReturnDetail->delete();

        return response()->json(['message' => 'Purchase Return Detail deleted successfully']);
    }
}
