<?php

namespace App\Http\Controllers\Api;

use App\Models\CoaMain;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class CoaMainApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        // \Log::info('CoaMainApiController@index called');
        $coaMains = CoaMain::all();
        return response()->json([
            'status' => 'success',
            'data' => $coaMains
        ], 200);
    }
        /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    // public function store(Request $request): JsonResponse
    // {
    //     $request->validate([
    //         'title' => 'required|string|max:255',
    //         'status' => 'required|boolean',
    //     ]);

    //     $coaMain = CoaMain::create($request->all());

    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'CoaMain created successfully.',
    //         'data' => $coaMain
    //     ], 201);
    // }

    /**
     * Display the specified resource.
     *
     * @param CoaMain $coaMain
     * @return JsonResponse
     */
    public function show(CoaMain $coaMain): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'data' => $coaMain
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param CoaMain $coaMain
     * @return JsonResponse
     */
    // public function update(Request $request, CoaMain $coaMain): JsonResponse
    // {
    //     $request->validate([
    //         'title' => 'required|string|max:255',
    //         'status' => 'required|boolean',
    //     ]);

    //     $coaMain->update($request->all());

    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'CoaMain updated successfully.',
    //         'data' => $coaMain
    //     ], 200);
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param CoaMain $coaMain
     * @return JsonResponse
     */
    // public function destroy(CoaMain $coaMain): JsonResponse
    // {
    //     $coaMain->delete();

    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'CoaMain deleted successfully.'
    //     ], 200);
    // }

}