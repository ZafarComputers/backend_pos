<?php

// app/Http/Controllers/Api/SizeController.php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index() {
        return Size::all();
    }

    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required|string|unique:sizes',
            'status' => 'required|in:Active,Inactive',
        ]);

        return Size::create($data);
    }

    public function show(Size $size) {
        return $size;
    }

    public function update(Request $request, Size $size) {
        $data = $request->validate([
            'title' => 'required|string|unique:sizes,title,' . $size->id,
            'status' => 'required|in:Active,Inactive',
        ]);

        $size->update($data);
        return $size;
    }

    public function destroy(Size $size) {
        $size->delete();
        return response()->json(['message' => 'Size deleted']);
    }
}
