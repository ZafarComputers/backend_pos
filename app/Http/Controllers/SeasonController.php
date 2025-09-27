<?php

// app/Http/Controllers/SeasonController.php
namespace App\Http\Controllers;

use App\Models\Season;
use Illuminate\Http\Request;

class SeasonController extends Controller
{
    public function index() {
        $seasons = Season::paginate(10);
        return view('seasons.index', compact('seasons'));
    }

    public function create() {
        return view('seasons.create');
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|unique:seasons',
            'status' => 'required|in:Active,Inactive',
        ]);

        Season::create($request->all());
        return redirect()->route('seasons.index')->with('success', 'Season created successfully.');
    }

    public function show(Season $season) {
        return view('seasons.show', compact('season'));
    }

    public function edit(Season $season) {
        return view('seasons.edit', compact('season'));
    }

    public function update(Request $request, Season $season) {
        $request->validate([
            'title' => 'required|string|unique:seasons,title,' . $season->id,
            'status' => 'required|in:Active,Inactive',
        ]);

        $season->update($request->all());
        return redirect()->route('seasons.index')->with('success', 'Season updated successfully.');
    }

    public function destroy(Season $season) {
        $season->delete();
        return redirect()->route('seasons.index')->with('success', 'Season deleted successfully.');
    }
}
