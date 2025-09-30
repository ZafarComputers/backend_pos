<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CoaSub;
use Illuminate\Http\Request;

class CoaSubApiController extends Controller
{
    public function index()
    {
        return CoaSub::with('coaMain')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'coa_main_id' => 'required|exists:coa_mains,id',
            'status' => 'required|in:active,inactive',
        ]);

        return CoaSub::create($validated);
    }

    public function show(CoaSub $coaSub)
    {
        return $coaSub->load('coaMain');
    }

    public function update(Request $request, CoaSub $coaSub)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'coa_main_id' => 'required|exists:coa_mains,id',
            'status' => 'required|in:active,inactive',
        ]);

        $coaSub->update($validated);
        return $coaSub;
    }

    public function destroy(CoaSub $coaSub)
    {
        $coaSub->delete();
        return response()->noContent();
    }
}
