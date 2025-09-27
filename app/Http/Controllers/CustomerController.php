<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

/**
 * CustomerController
 *
 * Handles CRUD for Customers
 */
class CustomerController extends Controller
{
    /**
     * Display all customers with pagination.
     */
    // public function index(Request $request): JsonResponse
    // {
    //     $perPage = $request->input('per_page', 10);
    //     $customers = Customer::with('city')->paginate($perPage);

    //     // return response()->json($customers);
    //     return view('customers.index', compact('customers', 'perPage'));
    // }

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $customers = Customer::with('city')->paginate($perPage);

        return view('customers.index', compact('customers', 'perPage'));
    }




    /**
     * Show the form for creating a new customer (for Blade).
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created customer.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'cnic' => 'required|string|max:20|unique:customers,cnic',
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:customers,email',
            'address' => 'nullable|string',
            'city_id' => 'required|exists:cities,id',
            'cell_no1' => 'required|string|max:15',
            'cell_no2' => 'nullable|string|max:15',
            'image_path' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $customer = Customer::create($request->all());

        return response()->json([
            'message' => 'Customer created successfully',
            'data' => $customer
        ], 201);
    }

    /**
     * Display a specific customer.
     */
    public function show(Customer $customer): JsonResponse
    {
        return response()->json($customer->load('city'));
    }

    /**
     * Show the form for editing customer (Blade).
     */
    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update customer.
     */
    public function update(Request $request, Customer $customer): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'cnic' => 'required|string|max:20|unique:customers,cnic,' . $customer->id,
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:customers,email,' . $customer->id,
            'address' => 'nullable|string',
            'city_id' => 'required|exists:cities,id',
            'cell_no1' => 'required|string|max:15',
            'cell_no2' => 'nullable|string|max:15',
            'image_path' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $customer->update($request->all());

        return response()->json([
            'message' => 'Customer updated successfully',
            'data' => $customer
        ]);
    }

    /**
     * Delete a customer.
     */
    public function destroy(Customer $customer): JsonResponse
    {
        $customer->delete();
        return response()->json(['message' => 'Customer deleted successfully']);
    }
}
