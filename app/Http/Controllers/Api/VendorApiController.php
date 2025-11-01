<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// Resources
use App\Http\Resources\VendorResource;  

// Models
use App\Models\Vendor;
use App\Models\Coa;


class VendorApiController extends Controller
{
    public function index() 
    {
        $vendors = Vendor::with('city.state.country')->get();
        return VendorResource::collection($vendors);
        // return Vendor::with('city')->get();
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'nullable|string|max:100',
            'phone' => 'required|string|max:25',
            'cnic' => 'nullable|string|unique:vendors',
            'city_id' => 'required|exists:cities,id',
            'address' => 'nullable|string',
            'status' => 'in:Active,Inactive',
        ]);

        return DB::transaction(function () use ($data) {
            // ✅ 1. Create Vendor
            $vendor = Vendor::create($data);

            // ✅ 2. Create related COA record
            Coa::create([
                'coa_sub_id' => 5, // fixed value
                'code' => 'VDR-' . str_pad($vendor->id, 4, '0', STR_PAD_LEFT), // e.g. VDR-0001
                'title' => $vendor->first_name . ' ' . $vendor->last_name,
                'type' => 'asset',
                'status' => 'Active',
                'vendor_id' => $vendor->id,
            ]);

            // ✅ 3. Return response
            return response()->json([
                'status' => true,
                'message' => 'Vendor and COA record created successfully.',
                'data' => $vendor,
            ]);
        });
    }


    public function show(Vendor $vendor)
    {
        $vendor->load('city.state.country'); // eager load all in one query
        return new VendorResource($vendor);
    
    }


    public function update(Request $request, Vendor $vendor)
    {
        $data = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'nullable|string|max:100',
            'phone' => 'required|string|max:25',
            'cnic' => 'nullable|string|unique:vendors,cnic,' . $vendor->id,
            'city_id' => 'required|exists:cities,id',
            'address' => 'nullable|string',
            'status' => 'in:Active,Inactive',
        ]);

        return DB::transaction(function () use ($vendor, $data) {
            // ✅ 1. Update Vendor
            $vendor->update($data);

            // ✅ 2. Find related COA
            $coa = Coa::where('vendor_id', $vendor->id)->first();

            // ✅ 3. If COA exists, update it — otherwise create it
            if ($coa) {
                $coa->update([
                    'title' => $vendor->first_name . ' ' . $vendor->last_name,
                    'status' => $vendor->status ?? 'Active',
                ]);
            } else {
                // If COA was missing for some reason, recreate it
                Coa::create([
                    'coa_sub_id' => 5,
                    'code' => 'VDR-' . str_pad($vendor->id, 4, '0', STR_PAD_LEFT),
                    'title' => $vendor->first_name . ' ' . $vendor->last_name,
                    'type' => 'asset',
                    'status' => $vendor->status ?? 'Active',
                    'vendor_id' => $vendor->id,
                ]);
            }

            // ✅ 4. Return success response
            return response()->json([
                'status' => true,
                'message' => 'Vendor and related COA updated successfully.',
                'data' => $vendor,
            ]);
        });
    }


    public function destroy(Vendor $vendor) 
    {
        $vendor->delete();
        return response()->json(['message' => 'Vendor deleted']);
    }
}