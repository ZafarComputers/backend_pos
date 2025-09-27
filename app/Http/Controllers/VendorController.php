<?php

// app/Http/Controllers/VendorController.php
namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\City;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index() {
        $vendors = Vendor::with('city')->paginate(10);
        return view('vendors.index', compact('vendors'));
    }

    public function create() {
        $cities = City::all();
        return view('vendors.create', compact('cities'));
    }

    public function store(Request $request) {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'cnic' => 'required|string|unique:vendors',
            'city_id' => 'required|exists:cities,id',
            'status' => 'required|in:Active,Inactive',
        ]);

        Vendor::create($request->all());
        return redirect()->route('vendors.index')->with('success', 'Vendor created successfully.');
    }

    public function show(Vendor $vendor) {
        return view('vendors.show', compact('vendor'));
    }

    public function edit(Vendor $vendor) {
        $cities = City::all();
        return view('vendors.edit', compact('vendor', 'cities'));
    }

    public function update(Request $request, Vendor $vendor) {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'cnic' => 'required|string|unique:vendors,cnic,' . $vendor->id,
            'city_id' => 'required|exists:cities,id',
            'status' => 'required|in:Active,Inactive',
        ]);

        $vendor->update($request->all());
        return redirect()->route('vendors.index')->with('success', 'Vendor updated successfully.');
    }

    public function destroy(Vendor $vendor) {
        $vendor->delete();
        return redirect()->route('vendors.index')->with('success', 'Vendor deleted successfully.');
    }
}
