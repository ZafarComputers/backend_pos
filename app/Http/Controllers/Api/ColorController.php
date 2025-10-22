<?php

// app/Http/Controllers/Api/ColorController.php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index() {
        return Color::all();
    }

    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required|string|unique:colors',
            'status' => 'required|in:Active,Inactive',
        ]);

        return Color::create($data);
    }

    public function show(Color $color) {
        return $color;
    }

    public function update(Request $request, Color $color) {
        $data = $request->validate([
            'title' => 'required|string|unique:colors,title,' . $color->id,
            'status' => 'required|in:Active,Inactive',
        ]);

        $color->update($data);
        return $color;
    }

    public function destroy(Color $color) {
        $color->delete();
        return response()->json(['message' => 'Color deleted']);
    }
}
