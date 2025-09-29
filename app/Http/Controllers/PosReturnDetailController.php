<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\POSReturnDetail;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

/**
 * @group POS Return Details
 *
 * APIs for managing POS Return Details
 */
class POS_Return_DetailController extends Controller
{
    /**
     * List POS Return Details (paginated).
     *
     * @queryParam per_page int Number of items per page. Example: 10
     * @response 200 {
     *   "success": true,
     *   "data": [{
     *       "id": 1,
     *       "pos_return_id": 2,
     *       "product_id": 5,
     *       "qty": 3,
     *       "return_unit_price": 1200
     *   }],
     *   "pagination": {"current_page":1,"per_page":10,"total":1,"last_page":1}
     * }
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->input('per_page', 10);
        $details = POSReturnDetail::paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $details->items(),
            'pagination' => [
                'current_page' => $details->currentPage(),
                'per_page'     => $details->perPage(),
                'total'        => $details->total(),
                'last_page'    => $details->lastPage(),
            ],
        ]);
    }

    /**
     * Store a new POS Return Detail.
     *
     * @bodyParam pos_return_id int required The POS Return ID. Example: 2
     * @bodyParam product_id int required The product ID. Example: 5
     * @bodyParam qty int required Quantity returned. Example: 3
     * @bodyParam return_unit_price number required Unit price at return time. Example: 1200
     * @response 201 {
     *   "success": true,
     *   "message": "POS Return Detail created successfully",
     *   "data": {
     *     "id": 10,
     *     "pos_return_id": 2,
     *     "product_id": 5,
     *     "qty": 3,
     *     "return_unit_price": 1200
     *   }
     * }
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'pos_return_id'     => 'required|exists:pos_returns,id',
            'product_id'        => 'required|exists:products,id',
            'qty'               => 'required|integer|min:1',
            'return_unit_price' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $detail = POSReturnDetail::create($request->only([
            'pos_return_id', 'product_id', 'qty', 'return_unit_price'
        ]));

        return response()->json([
            'success' => true,
            'message' => 'POS Return Detail created successfully',
            'data'    => $detail,
        ], 201);
    }

    /**
     * Show a POS Return Detail.
     *
     * @urlParam id int required The ID of the detail. Example: 1
     * @response 200 {
     *   "success": true,
     *   "data": {
     *     "id": 1,
     *     "pos_return_id": 2,
     *     "product_id": 5,
     *     "qty": 3,
     *     "return_unit_price": 1200
     *   }
     * }
     */
    public function show(POSReturnDetail $posReturnDetail): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $posReturnDetail,
        ]);
    }

    /**
     * Update a POS Return Detail.
     *
     * @urlParam id int required The ID of the detail. Example: 1
     * @bodyParam qty int The new quantity. Example: 5
     * @bodyParam return_unit_price number The new price. Example: 1100
     * @response 200 {
     *   "success": true,
     *   "message": "POS Return Detail updated successfully",
     *   "data": {
     *     "id": 1,
     *     "pos_return_id": 2,
     *     "product_id": 5,
     *     "qty": 5,
     *     "return_unit_price": 1100
     *   }
     * }
     */
    public function update(Request $request, POSReturnDetail $posReturnDetail): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'qty'               => 'sometimes|required|integer|min:1',
            'return_unit_price' => 'sometimes|required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $posReturnDetail->update($request->only(['qty', 'return_unit_price']));

        return response()->json([
            'success' => true,
            'message' => 'POS Return Detail updated successfully',
            'data'    => $posReturnDetail,
        ]);
    }

    /**
     * Delete a POS Return Detail.
     *
     * @urlParam id int required The ID of the detail. Example: 1
     * @response 200 {
     *   "success": true,
     *   "message": "POS Return Detail deleted successfully"
     * }
     */
    public function destroy(POSReturnDetail $posReturnDetail): JsonResponse
    {
        $posReturnDetail->delete();

        return response()->json([
            'success' => true,
            'message' => 'POS Return Detail deleted successfully',
        ]);
    }
}
