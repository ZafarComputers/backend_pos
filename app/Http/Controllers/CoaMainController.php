<?php

namespace App\Http\Controllers;

use App\Models\CoaMain;
use Illuminate\Http\Request;

class CoaMainController extends Controller
{
    public function index()
    {
        $coaMains = CoaMain::all();
        return view('coa_mains.index', compact('coaMains'));
    }

    public function create()
    {
        return view('coa_mains.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        CoaMain::create($request->all());

        return redirect()->route('coa-mains.index')
                         ->with('success', 'COA-Main created successfully.');
    }

    public function show(CoaMain $coaMain)
    {
        return view('coa_mains.show', compact('coaMain'));
    }

    public function edit(CoaMain $coaMain)
    {
        return view('coa_mains.edit', compact('coaMain'));
    }

    public function update(Request $request, CoaMain $coaMain)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        $coaMain->update($request->all());

        return redirect()->route('coa-mains.index')
                         ->with('success', 'COA-Main updated successfully.');
    }

    public function destroy(CoaMain $coaMain)
    {
        $coaMain->delete();
        return redirect()->route('coa-mains.index')
                         ->with('success', 'COA-Main deleted successfully.');
    }
}
