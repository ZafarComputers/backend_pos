<?php

// app/Http/Controllers/MaterialController.php
namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index() {
        $materials = Material::paginate(10);
        return view('materials.index', compact('materials'));
    }

    public function create() {
        return view('materials.create');
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|unique:materials',
            'status' => 'required|in:Active,Inactive',
        ]);

        Material::create($request->all());
        return redirect()->route('materials.index')->with('success', 'Material created successfully.');
    }

    public function show(Material $material) {
        return view('materials.show', compact('material'));
    }

    public function edit(Material $material) {
        return view('materials.edit', compact('material'));
    }

    public function update(Request $request, Material $material) {
        $request->validate([
            'title' => 'required|string|unique:materials,title,' . $material->id,
            'status' => 'required|in:Active,Inactive',
        ]);

        $material->update($request->all());
        return redirect()->route('materials.index')->with('success', 'Material updated successfully.');
    }

    public function destroy(Material $material) {
        $material->delete();
        return redirect()->route('materials.index')->with('success', 'Material deleted successfully.');
    }
}
