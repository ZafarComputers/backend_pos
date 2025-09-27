<?php

// app/Http/Controllers/Api/SeasonController.php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Season;
use Illuminate\Http\Request;

class SeasonController extends Controller
{
    public function index() {
        return Season::all();
    }

    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required|string|unique:seasons',
            'status' => 'required|in:Active,Inactive',
        ]);

        return Season::create($data);
    }

    public function show(Season $season) {
        return $season;
    }

    public function update(Request $request, Season $season) {
        $data = $request->validate([
            'title' => 'required|string|unique:seasons,title,' . $season->id,
            'status' => 'required|in:Active,Inactive',
        ]);

        $season->update($data);
        return $season;
    }

    public function destroy(Season $season) {
        $season->delete();
        return response()->json(['message' => 'Season deleted']);
    }
}
