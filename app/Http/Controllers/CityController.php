<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

/**
 * Class CityController
 *
 * Handles CRUD operations for the City resource.
 * Supports both Blade views (Web) and JSON responses (API).
 */
class CityController extends Controller
{
    /**
     * Display a listing of all cities with their states and countries.
     *
     * @return \Illuminate\View\View|JsonResponse
     */
    public function index()
    {
        try {
            $cities = City::with(['state.country'])->get();

            // If request is API, return JSON, else show Blade view
            if (request()->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'data' => $cities,
                ], 200);
            }

            return view('cities.index', compact('cities'));
        } catch (\Exception $e) {
            if (request()->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to retrieve cities: ' . $e->getMessage(),
                ], 500);
            }

            return redirect()->back()->withErrors([
                'error' => 'Failed to retrieve cities: ' . $e->getMessage(),
            ]);
        }
    }

    /**
     * Show the form for creating a new city (Web only).
     */
    public function create()
    {
        return view('cities.create');
    }

    /**
     * Store a newly created city in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'state_id' => 'required|exists:states,id',
                'status' => 'nullable|string|in:active,inactive',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $city = City::create($request->only(['title', 'state_id', 'status']));

            return response()->json([
                'success' => true,
                'message' => 'City created successfully',
                'data' => $city->load('state.country'),
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create city: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified city with its state and country.
     *
     * @param City $city
     * @return JsonResponse
     */
    public function show(City $city): JsonResponse
    {
        try {
            return response()->json([
                'success' => true,
                'data' => $city->load('state.country'),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve city: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified city (Web only).
     */
    public function edit(City $city)
    {
        return view('cities.edit', compact('city'));
    }

    /**
     * Update the specified city in storage.
     *
     * @param Request $request
     * @param City $city
     * @return JsonResponse
     */
    public function update(Request $request, City $city): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'state_id' => 'required|exists:states,id',
                'status' => 'nullable|string|in:active,inactive',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $city->update($request->only(['title', 'state_id', 'status']));

            return response()->json([
                'success' => true,
                'message' => 'City updated successfully',
                'data' => $city->load('state.country'),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update city: ' . $e->getMessage(),
            ], 500);
        }
    }

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
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete city: ' . $e->getMessage(),
            ], 500);
        }
    }
}
