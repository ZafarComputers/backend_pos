<?php

// app/Http/Controllers/Api/MaterialController.php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index() {
        return Material::all();
    }

    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required|string|unique:materials',
            'status' => 'required|in:Active,Inactive',
        ]);

        return Material::create($data);
    }

    public function show(Material $material) {
        return $material;
    }

    public function update(Request $request, Material $material) {
        $data = $request->validate([
            'title' => 'required|string|unique:materials,title,' . $material->id,
            'status' => 'required|in:Active,Inactive',
        ]);

        $material->update($data);
        return $material;
    }

    public function destroy(Material $material) {
        $material->delete();
        return response()->json(['message' => 'Material deleted']);
    }
}
