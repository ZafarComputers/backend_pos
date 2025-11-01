<?php

namespace App\Http\Controllers\Api;

// Controllers
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;


// Resources
use App\Http\Resources\CustomerResource;

// Models
use App\Models\Customer;
use App\Models\Coa;
use App\Models\Pos;

class CustomerApiController extends Controller
{

    // getCustomerOrderInvoices
    public function getCustomerOrderInvoices() 
    {
        $bridalData = Pos::all();
        return $bridalData;          
    }


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
            'cnic' => 'string|max:20',
            'name' => 'required|string|max:255',
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

        return DB::transaction(function () use ($request) {
            // ✅ 1. Create Customer
            $customer = Customer::create($request->all());

            // ✅ 2. Create related COA record with coa_sub_id = 5
            Coa::create([
                'coa_sub_id' => 5, // Updated sub-account group
                'code' => 'CUST-' . str_pad($customer->id, 4, '0', STR_PAD_LEFT),
                'title' => $customer->name,
                'type' => 'asset',
                'status' => ucfirst($customer->status ?? 'Active'),
                'customer_id' => $customer->id,
            ]);

            // ✅ 3. Return response with COA linkage
            return response()->json([
                'success' => true,
                'message' => 'Customer created successfully and linked with COA.',
                'data' => new CustomerResource($customer->load('city')),
            ], 201);
        });
    }

    /**
     * Display the specified customer.
     */
    public function show(Customer $customer): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => new CustomerResource($customer->load(['city','coa'])),
        ], 200);
    }

    /**
     * Update the specified customer.
     */
    public function update(Request $request, Customer $customer): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'cnic' => 'string|max:20',
            'name' => 'required|string|max:255',
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

        return DB::transaction(function () use ($customer, $request) {
            // ✅ 1. Update customer record
            $customer->update($request->all());

            // ✅ 2. Find related COA
            $coa = Coa::where('customer_id', $customer->id)->first();

            // ✅ 3. Update or create COA record
            if ($coa) {
                $coa->update([
                    'title' => $customer->name,
                    'status' => ucfirst($customer->status ?? 'Active'),
                ]);
            } else {
                // If COA missing, recreate safely
                Coa::create([
                    'coa_sub_id' => 11,
                    'code' => 'CUST-' . str_pad($customer->id, 4, '0', STR_PAD_LEFT),
                    'title' => $customer->name,
                    'type' => 'asset',
                    'status' => ucfirst($customer->status ?? 'Active'),
                    'customer_id' => $customer->id,
                ]);
            }

            // ✅ 4. Return success response
            return response()->json([
                'success' => true,
                'message' => 'Customer and related COA updated successfully.',
                'data' => new \App\Http\Resources\CustomerResource($customer->load('city')),
            ]);
        });
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
