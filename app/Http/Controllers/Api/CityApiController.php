<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

// Resources
use App\Http\Resources\CityResource;

// Models
use App\Models\City;

/**
 * Class CityController (API)
 *
 * Handles CRUD operations for the City resource via API.
 * Includes pagination, validation, and relational loading (state + country).
 *
 * @package App\Http\Controllers\API
 */
class CityApiController extends Controller
{
    /**
     * Display a paginated listing of all cities with their states and countries.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->input('per_page', 10);
        // $cities = City::with(['state', 'country'])->paginate($perPage);
        // $cities = City::all()->paginate($perPage);
        $cities = City::all();
        return response()->json([
            'status' => true,
            'message' => 'Cities list retrieved successfully.',
            // 'summary' => $summary,
            'data' => CityResource::collection($cities),
        ]);

        // try {
        //     $perPage = $request->input('per_page', 10);

        //     $cities = City::with(['state.country'])->paginate($perPage);

        //     return response()->json([
        //         'success'    => true,
        //         'data'       => $cities->items(),
        //         'pagination' => [
        //             'current_page' => $cities->currentPage(),
        //             'per_page'     => $cities->perPage(),
        //             'total'        => $cities->total(),
        //             'last_page'    => $cities->lastPage(),
        //         ],
        //     ], 200);

        // } catch (\Exception $e) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Failed to retrieve cities: ' . $e->getMessage(),
        //     ], 500);
        // }


    }

    /**
     * Store a newly created city in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255|unique:cities,title',
            'state_id' => 'nullable|exists:states,id', // if related to state
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $city = City::create([
            'title' => $request->title,
            'state_id' => $request->state_id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'City created successfully.',
            'data' => new CityResource($city),
        ], 201);
    }

    // public function store(Request $request): JsonResponse
    // {
    //     try {
    //         $validator = Validator::make($request->all(), [
    //             'title'    => 'required|string|max:255|unique:cities,title',
    //             'state_id' => 'required|exists:states,id',
    //             'status'   => 'nullable|string|in:active,inactive',
    //         ]);

    //         if ($validator->fails()) {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'Validation failed',
    //                 'errors'  => $validator->errors(),
    //             ], 422);
    //         }

    //         $city = City::create($request->only(['title', 'state_id', 'status']));

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'City created successfully',
    //             'data'    => $city->load('state.country'),
    //         ], 201);

    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Failed to create city: ' . $e->getMessage(),
    //         ], 500);
    //     }
    // }

    /**
     * Display the specified city with its state and country.
     *
     * @param City $city
     * @return JsonResponse
     */
    public function show(City $city)
    {
        return response()->json([
            'status' => true,
            'message' => 'City retrieved successfully.',
            'data' => new CityResource($city),
        ]);
    }
    // public function show(City $city): JsonResponse
    // {
    //     $cityId = $city->id;
    //     // ✅ Include employee
    //     // $cities = Pos::with(['state', 'country'])->find($cityId);
    //     $cities = City::findOrFail($cityId);

    //     if (!$cities) {
    //         return response()->json([
    //             'status' => false, 
    //             'message' => 'POS not found.'
    //         ], 404);
    //     }

    //     try {
    //         return response()->json([
    //             'success' => true,
    //             // 'data'    => $city->load('state.country'),
    //             'data' => CityResource::collection($cities),

    //         ], 200);

    //     } catch (ModelNotFoundException $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'City not found',
    //         ], 404);

    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Failed to retrieve city: ' . $e->getMessage(),
    //         ], 500);
    //     }
    // }

    /**
     * Update the specified city in storage.
     *
     * @param Request $request
     * @param City $city
     * @return JsonResponse
     */
    public function update(Request $request, City $city)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255|unique:cities,title,' . $city->id,
            'state_id' => 'nullable|exists:states,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $city->update([
            'title' => $request->title,
            'state_id' => $request->state_id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'City updated successfully.',
            'data' => new CityResource($city),
        ]);
    }

    // public function update(Request $request, City $city): JsonResponse
    // {
    //     try {
    //         $validator = Validator::make($request->all(), [
    //             'title'    => 'required|string|max:255|unique:cities,title,' . $city->id,
    //             'state_id' => 'required|exists:states,id',
    //             'status'   => 'nullable|string|in:active,inactive',
    //         ]);

    //         if ($validator->fails()) {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'Validation failed',
    //                 'errors'  => $validator->errors(),
    //             ], 422);
    //         }

    //         $city->update($request->only(['title', 'state_id', 'status']));

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'City updated successfully',
    //             'data'    => $city->load('state.country'),
    //         ], 200);

    //     } catch (ModelNotFoundException $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'City not found',
    //         ], 404);

    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Failed to update city: ' . $e->getMessage(),
    //         ], 500);
    //     }
    // }

    /**
     * Remove the specified city from storage.
     *
     * @param City $city
     * @return JsonResponse
     */
    public function destroy(City $city): JsonResponse
    {
        try {
            $city->delete();

            return response()->json([
                'success' => true,
                'message' => 'City deleted successfully',
            ], 200);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'City not found',
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete city: ' . $e->getMessage(),
            ], 500);
        }
    }
}
