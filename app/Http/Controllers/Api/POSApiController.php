<?php

namespace App\Http\Controllers\Api;

use App\Models\Pos;
use App\Models\PosDetail;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PosResource; // Keep this import for when the file is created
use Illuminate\Support\Facades\Log;


class PosApiController extends Controller
{
    public function index()
    {
        return Pos::with('posDetails')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'inv_date'    => 'required|date',
            'inv_amount'  => 'required|numeric',
            'tax'         => 'nullable|numeric',
            'discPer'     => 'nullable|numeric',
            'discount'    => 'nullable|numeric',
            'details'     => 'required|array|min:1',
            'details.*.product_id' => 'required|exists:products,id',
            'details.*.qty'        => 'required|integer|min:1',
            'details.*.sale_price' => 'required|numeric|min:0',
        ]);

        // ✅ Save POS
        $pos = Pos::create(collect($validated)->except('details')->toArray());

        // ✅ Save details with relation (pos_id auto added)
        $pos->details()->createMany($validated['details']);

        return response()->json($pos->load(['customer', 'details.product']), 201);
    }

    // public function show(Pos $po)
    public function show($id)
    {
        $pos = Pos::with(['customer', 'posDetails.product'])->find($id);
        return response()->json($pos);
    }


    public function update(Request $request, $id)
    {
        \Log::info('Updating POS ID from route: ' . $id);

        // Explicitly find the Pos instance
        $pos = Pos::findOrFail($id);

        \Log::info('Pos Instance: ', ['id' => $pos->id, 'attributes' => $pos->getAttributes()]);

        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'inv_date' => 'required|date',
            'inv_amount' => 'required|numeric',
            'tax' => 'nullable|numeric',
            'discPer' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'details' => 'array',
            'details.*.product_id' => 'required|exists:products,id',
            'details.*.qty' => 'required|integer|min:1',
            'details.*.sale_price' => 'required|numeric',
        ]);

        \Log::info('Validated Data: ', $validated);

        $pos->update($request->only(['customer_id', 'inv_date', 'inv_amount', 'tax', 'discPer', 'discount']));

        // Delete existing details
        $pos->posDetails()->delete();

        // Create new details with explicit pos_id and error handling
        if (!empty($validated['details'])) {
            foreach ($validated['details'] as $detail) {
                \Log::info('Creating PosDetail for pos_id: ' . $pos->id, $detail);
                try {
                    PosDetail::create([
                        'pos_id' => $pos->id,
                        'product_id' => $detail['product_id'],
                        'qty' => $detail['qty'],
                        'sale_price' => $detail['sale_price'],
                    ]);
                } catch (\Exception $e) {
                    \Log::error('Failed to create PosDetail: ' . $e->getMessage());
                }
            }
        }

        \DB::enableQueryLog();
        $updatedPos = $pos->load('posDetails');
        \Log::info('SQL Queries: ', \DB::getQueryLog());

        return new PosResource($updatedPos);
    }


    public function destroy(Pos $pos)
    {
        Log::info('Deleting POS ID: ' . $pos->id);
        $pos->delete();
        return response()->json(['message' => 'POS record deleted successfully'], 200);
    }
}