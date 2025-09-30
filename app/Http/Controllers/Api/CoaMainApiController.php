<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CoaMain;
use Illuminate\Http\Request;

class CoaMainApiController extends Controller
{
    public function index()
    {
        return CoaMain::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        return CoaMain::create($validated);
    }

    public function show(CoaMain $coaMain)
    {
        return $coaMain;
    }

    public function update(Request $request, CoaMain $coaMain)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        $coaMain->update($validated);
        return $coaMain;
    }

    public function destroy(CoaMain $coaMain)
    {
        $coaMain->delete();
        return response()->noContent();
    }
}
