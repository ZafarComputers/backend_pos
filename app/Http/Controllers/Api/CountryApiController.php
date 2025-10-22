<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use App\Models\Country;

/**
 * Class CountryController
 *
 * Handles API operations for the Country resource.
 * Last updated: September 27, 2025.
 */
class CountryApiController extends Controller
{
    /**
     * Display a paginated listing of countries.
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $perPage = (int) $request->input('per_page', 10);

            $countries = Country::paginate($perPage);

            return response()->json([
                'success'    => true,
                'data'       => $countries->items(),
                'pagination' => [
                    'current_page' => $countries->currentPage(),
                    'per_page'     => $countries->perPage(),
                    'total'        => $countries->total(),
                    'last_page'    => $countries->lastPage(),
                ],
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve countries: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Store a newly created country.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title'    => 'required|string|max:255',
            'code'     => 'required|string|max:10|unique:countries,code',
            'currency' => 'required|string|max:10',
            'status'   => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors'  => $validator->errors(),
            ], 422);
        }

        try {
            $country = Country::create($request->only(['title', 'code', 'currency', 'status']));

            return response()->json([
                'success' => true,
                'message' => 'Country created successfully',
                'data'    => $country,
            ], 201);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create country: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified country.
     */
    public function show(Country $country): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data'    => $country,
        ]);
    }

    /**
     * Update the specified country.
     */
    public function update(Request $request, Country $country): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title'    => 'required|string|max:255',
            'code'     => 'required|string|max:10|unique:countries,code,' . $country->id,
            'currency' => 'required|string|max:10',
            'status'   => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors'  => $validator->errors(),
            ], 422);
        }

        try {
            $country->update($request->only(['title', 'code', 'currency', 'status']));

            return response()->json([
                'success' => true,
                'message' => 'Country updated successfully',
                'data'    => $country,
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update country: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified country.
     */
    public function destroy(Country $country): JsonResponse
    {
        try {
            $country->delete();

            return response()->json([
                'success' => true,
                'message' => 'Country deleted successfully',
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete country: ' . $e->getMessage(),
            ], 500);
        }
    }
}
