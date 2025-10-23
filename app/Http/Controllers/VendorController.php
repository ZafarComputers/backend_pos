<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\VendorResource;
use App\Models\Vendor;

class VendorController extends Controller
{
    /**
     * Display a listing of vendors
     */
    public function index()
    {
        $vendors = Vendor::with('city.state.country')->get();

        return response()->json([
            'success' => true,
            'message' => 'Vendors retrieved successfully.',
            'data' => VendorResource::collection($vendors),
        ]);
    }

    /**
     * Store a newly created vendor
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'nullable|string|email|max:100',
            'phone'      => 'nullable|string|max:25',
            'cnic'       => 'required|string|unique:vendors,cnic',
            'city_id'    => 'required|exists:cities,id',
            'address'    => 'required|string|max:255',
            'status'     => 'required|in:Active,Inactive',
        ]);

        $vendor = Vendor::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Vendor created successfully.',
            'data' => new VendorResource($vendor),
        ], 201);
    }

    /**
     * Display the specified vendor
     */
    public function show(Vendor $vendor)
    {
        $vendor->load('city.state.country');

        return response()->json([
            'success' => true,
            'message' => 'Vendor details retrieved successfully.',
            'data' => new VendorResource($vendor),
        ]);
    }

    /**
     * Update the specified vendor
     */
    public function update(Request $request, Vendor $vendor)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'cnic'       => 'required|string|unique:vendors,cnic,' . $vendor->id,
            'city_id'    => 'required|exists:cities,id',
            'address'    => 'required|string|max:255',
            'status'     => 'required|in:Active,Inactive',
        ]);

        $vendor->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Vendor updated successfully.',
            'data' => new VendorResource($vendor->fresh()),
        ]);
    }

    /**
     * Remove the specified vendor
     */
    public function destroy(Vendor $vendor)
    {
        $vendor->delete();

        return response()->json([
            'success' => true,
            'message' => 'Vendor deleted successfully.',
        ]);
    }
}
