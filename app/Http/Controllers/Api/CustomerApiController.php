<?php

namespace App\Http\Controllers\Api;

// Controllers
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;

// Resources
use App\Http\Resources\CustomerResource;

// Models
use App\Models\Customer;

class CustomerApiController extends Controller
{
    /**
     * Display all customers.
     */
    public function index(Request $request): JsonResponse
    {
        $customers = Customer::with('city')->latest()->get();

        return response()->json([
            'success' => true,
            'data' => CustomerResource::collection($customers),
            'total' => $customers->count(),
        ], 200);
    }

    /**
     * Store a newly created customer.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'cnic' => 'required|string|max:20|unique:customers,cnic',
            'name' => 'required|string|max:255',
            // 'email' => 'nullable|email|unique:customers,email',
            'email' => 'nullable|email',
            'address' => 'nullable|string|max:500',
            'city_id' => 'required|exists:cities,id',
            'cell_no1' => 'required|string|max:15',
            'cell_no2' => 'nullable|string|max:15',
            'image_path' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',
            'cnic2' => 'nullable|string|max:20',
            'name2' => 'nullable|string|max:255',
            'cell_no3' => 'nullable|string|max:15',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $customer = Customer::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Customer created successfully',
            'data' => new CustomerResource($customer->load('city')),
        ], 201);
    }

    /**
     * Display the specified customer.
     */
    public function show(Customer $customer): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => new CustomerResource($customer->load('city')),
        ], 200);
    }

    /**
     * Update the specified customer.
     */
    public function update(Request $request, Customer $customer): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'cnic' => 'required|string|max:20|unique:customers,cnic,' . $customer->id,
            'name' => 'required|string|max:255',
            // 'email' => 'nullable|email|unique:customers,email,' . $customer->id,
            'email' => 'nullable|email',
            'address' => 'nullable|string|max:500',
            'city_id' => 'required|exists:cities,id',
            'cell_no1' => 'required|string|max:15',
            'cell_no2' => 'nullable|string|max:15',
            'image_path' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',
            'cnic2' => 'nullable|string|max:20',
            'name2' => 'nullable|string|max:255',
            'cell_no3' => 'nullable|string|max:15',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $customer->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Customer updated successfully',
            'data' => new CustomerResource($customer->load('city')),
        ], 200);
    }

    /**
     * Remove the specified customer.
     */
    public function destroy(Customer $customer): JsonResponse
    {
        try {
            $customer->delete();

            return response()->json([
                'success' => true,
                'message' => 'Customer deleted successfully',
            ], 200);
        } catch (QueryException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete customer due to related data or database constraints',
                'error' => $e->getMessage(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred while deleting the customer',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
