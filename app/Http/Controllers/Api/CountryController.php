<?php

// namespace App\Http\Controllers\API;

// use App\Http\Controllers\Controller;
// use App\Models\Country;
// use Illuminate\Http\Request;
// use Illuminate\Http\JsonResponse;
// use Illuminate\Support\Facades\Validator;



namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\State;


/**
 * Class CountryController
 *
 * Handles API operations for the Country resource.
 * Last updated: 02:39 PM PKT, September 27, 2025.
 */
class CountryController extends Controller
{
    /**
     * Display a paginated listing of all countries.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $perPage = $request->input('per_page', 10);

            // Fetch countries with pagination
            $countries = Country::paginate($perPage);

            return response()->json([
                'success' => true,
                'data' => $countries->items(),
                'pagination' => [
                    'current_page' => $countries->currentPage(),
                    'per_page'     => $countries->perPage(),
                    'total'        => $countries->total(),
                    'last_page'    => $countries->lastPage(),
                ],
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve countries: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Store a newly created country.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            // Validate request data
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

            // Create country
            $country = Country::create($request->only(['title', 'code', 'currency', 'status']));

            return response()->json([
                'success' => true,
                'message' => 'Country created successfully',
                'data'    => $country,
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create country: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display a specific country.
     *
     * @param Country $country
     * @return JsonResponse
     */
    public function show(Country $country): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data'    => $country,
        ], 200);
    }

    /**
     * Update a country.
     *
     * @param Request $request
     * @param Country $country
     * @return JsonResponse
     */
    public function update(Request $request, Country $country): JsonResponse
    {
        try {
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

            // Update country
            $country->update($request->only(['title', 'code', 'currency', 'status']));

            return response()->json([
                'success' => true,
                'message' => 'Country updated successfully',
                'data'    => $country,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update country: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Delete a country.
     *
     * @param Country $country
     * @return JsonResponse
     */
    public function destroy(Country $country): JsonResponse
    {
        try {
            $country->delete();

            return response()->json([
                'success' => true,
                'message' => 'Country deleted successfully',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete country: ' . $e->getMessage(),
            ], 500);
        }
    }
}
