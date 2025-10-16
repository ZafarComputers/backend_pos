<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PosReturnResource;
use App\Models\PosReturn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PosReturnApiController extends Controller
{
    /**
     * Display a listing of all POS Returns.
     */
    public function index()
    {
        $posReturns = PosReturn::with(['customer', 'pos', 'details.product'])
            ->latest()
            ->get();

        return response()->json([
            'status' => true,
            'data' => PosReturnResource::collection($posReturns),
        ]);
    }

    /**
     * Store a newly created POS Return.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'vendor_id'   => 'nullable|exists:vendors,id',
            'invRet_date' => 'required|date',
            'pos_id'      => 'required|exists:pos,id',
            'return_inv_amout' => 'required|numeric|min:0',
            'reason' => 'nullable|string',
            'details'     => 'required|array|min:1',
            'details.*.product_id' => 'required|exists:products,id',
            'details.*.qty'        => 'required|integer|min:1',
            'details.*.return_unit_price' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {
            $posReturnData = collect($validated)->except('details')->toArray();
            $posReturn = PosReturn::create($posReturnData);

            foreach ($validated['details'] as $detail) {
                $posReturn->details()->create($detail);
            }

            DB::commit();

            $posReturn->load(['customer', 'pos', 'details.product']);

            return response()->json([
                'status' => true,
                'message' => 'POS Return created successfully.',
                'data' => new PosReturnResource($posReturn),
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Failed to create POS Return.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display a single POS Return.
     */
    public function show($id)
    {
        $posReturn = PosReturn::with(['customer', 'pos', 'details.product'])->find($id);

        if (!$posReturn) {
            return response()->json([
                'status' => false,
                'message' => 'POS Return not found.',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => new PosReturnResource($posReturn),
        ]);
    }

    /**
     * Update a POS Return.
     */
    public function update(Request $request, $id)
    {
        $posReturn = PosReturn::findOrFail($id);

        $data = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'pos_id' => 'required|exists:pos,id',
            'invRet_date' => 'required|date',
            'return_inv_amout' => 'required|numeric',
            'details' => 'required|array|min:1',
            'reason' => 'nullable|string',
            'details.*.product_id' => 'required|exists:products,id',
            'details.*.qty' => 'required|integer|min:1',
            'details.*.return_unit_price' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {
            $posReturn->update($data);

            // delete old details
            $posReturn->details()->delete();

            // insert new details (Eloquent auto-fills pos_return_id)
            foreach ($data['details'] as $detail) {
                $posReturn->details()->create($detail);
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'POS Return updated successfully.',
                'data' => new PosReturnResource($posReturn->load(['customer', 'pos', 'details.product']))
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Failed to update POS Return.',
                'error' => $e->getMessage(),
            ]);
        }
    }


    /**
     * Remove a POS Return.
     */
    public function destroy(PosReturn $posReturn)
    {
        $posReturn->details()->delete();
        $posReturn->delete();

        return response()->json([
            'status' => true,
            'message' => 'POS Return deleted successfully.',
        ]);
    }
}
