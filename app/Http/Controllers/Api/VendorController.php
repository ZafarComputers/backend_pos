<?php

// app/Http/Controllers/Api/VendorController.php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index() {
        return Vendor::with('city')->get();
    }

    public function store(Request $request) {
        $data = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'cnic' => 'required|string|unique:vendors',
            'city_id' => 'required|exists:cities,id',
            'status' => 'required|in:Active,Inactive',
        ]);
        return Vendor::create($data);
    }

    public function show(Vendor $vendor) {
        return $vendor->load('city');
    }

    public function update(Request $request, Vendor $vendor)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'cnic'       => 'required|string|unique:vendors,cnic,' . $vendor->id,
            'city_id'    => 'required|exists:cities,id',
            'status'     => 'required|in:Active,Inactive',
        ]);

        $vendor->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Vendor updated successfully.',
            'vendor'  => $vendor->fresh() // ensures we return updated data
        ]);
    }

    public function destroy(Vendor $vendor) {
        $vendor->delete();
        return response()->json(['message' => 'Vendor deleted']);
    }
}
