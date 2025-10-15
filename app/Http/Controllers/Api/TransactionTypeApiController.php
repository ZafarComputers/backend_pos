<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TransactionType;
use App\Http\Resources\TransactionTypeResource;
use Illuminate\Http\Request;

class TransactionTypeApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactionTypes = TransactionType::all();
        return response()->json([
            'status' => true,
            'data' => TransactionTypeResource::collection($transactionTypes)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'transType' => 'required|string|unique:transaction_types,transType',
            'code' => 'required|string|max:10|unique:transaction_types,code',
        ]);

        $transactionType = TransactionType::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Transaction Type created successfully.',
            'data' => new TransactionTypeResource($transactionType)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(TransactionType $transactionType)
    {
        return response()->json([
            'status' => true,
            'data' => new TransactionTypeResource($transactionType)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TransactionType $transactionType)
    {
        $data = $request->validate([
            'transType' => 'required|string|unique:transaction_types,transType,' . $transactionType->id,
            'code' => 'required|string|max:10|unique:transaction_types,code,' . $transactionType->id,
        ]);

        $transactionType->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Transaction Type updated successfully.',
            'data' => new TransactionTypeResource($transactionType)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TransactionType $transactionType)
    {
        $transactionType->delete();

        return response()->json([
            'status' => true,
            'message' => 'Transaction Type deleted successfully.'
        ]);
    }
}
