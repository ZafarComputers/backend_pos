<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PosReturn;
use Illuminate\Http\Request;

class PosReturnApiController extends Controller
{
    // WEB INDEX
    public function index()
    {
        $posReturns = PosReturn::with(['customer', 'details'])->get();

        return response()->json([
            'message' => 'POS Returns list',
            'data' => $posReturns
        ]);

    }

    // API INDEX
    public function apiIndex()
    {
        return response()->json(PosReturn::with(['customer', 'details'])->get());
    }

    public function create()
    {
        return view('pos_returns.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'vendor_id'   => 'nullable|exists:vendors,id',
            'invRet_date' => 'required|date',
            'pos_inv_no'  => 'required|string|unique:pos_returns,pos_inv_no',
            'return_inv_amout' => 'required|numeric',
            'details'     => 'required|array|min:1',
            'details.*.product_id' => 'required|exists:products,id',
            'details.*.qty'        => 'required|integer|min:1',
            'details.*.return_unit_price'      => 'required|numeric|min:0',
        ]);

        $posReturn = PosReturn::create($data);

        foreach ($data['details'] as $detail) {
            $posReturn->details()->create($detail);
        }

        $posReturn->load(['customer', 'details.product']);

        return response()->json([
            'message' => 'POS Return created',
            'data'    => $posReturn
        ]);
    }

    public function show($id)
    {
        return response()->json(PosReturn::with(['customer', 'details'])->findOrFail($id));
    }

    public function update(Request $request, PosReturn $posReturn, $id)
    {
         // Explicitly find the Pos instance
        $posReturn = PosReturn::findOrFail($id);
        // dd($posReturn);

        // Step 1: Validation
        $validated = $request->validate([
            'customer_id'        => 'sometimes|exists:customers,id',
            'vendor_id'          => 'sometimes|exists:vendors,id',
            'invRet_date'        => 'sometimes|date',
            'pos_inv_no'         => 'sometimes|string|max:50',
            'return_inv_amount'  => 'sometimes|numeric',

            // Details validation
            'details'                     => 'nullable|array|min:1',
            'details.*.product_id'        => 'required_with:details|exists:products,id',
            'details.*.qty'               => 'required_with:details|integer|min:1',
            'details.*.return_unit_price' => 'required_with:details|numeric|min:0',
        ]);

        // Step 2: Update PosReturn (ignore details for now)
        $posReturn->update(collect($validated)->except('details')->toArray());

        // Step 3: If details provided → refresh them
        if (!empty($validated['details'])) {
            // Delete old details
            $posReturn->details()->delete();

            // Insert new details
            foreach ($validated['details'] as $detail) {
                $posReturn->details()->create([
                    'pos_return_id' => $posReturn->id,   // FK to parent return
                    'product_id'    => $detail['product_id'],
                    'qty'           => $detail['qty'],
                    'return_unit_price'    => $detail['return_unit_price'],
                ]);
            }
        }

        // Step 4: Return updated object with relations
        return response()->json([
            'message' => 'POS Return updated successfully',
            'data'    => $posReturn->load(['customer', 'details'])
        ]);
    }


    public function destroy($id)
    {
        $posReturn = PosReturn::findOrFail($id);
        $posReturn->delete();

        return response()->json(['message' => 'POS Return deleted']);
    }
}
