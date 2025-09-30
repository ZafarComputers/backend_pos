<?php

namespace App\Http\Controllers;

use App\Models\CoaSub;
use App\Models\CoaMain;
use Illuminate\Http\Request;

class CoaSubController extends Controller
{
    public function index()
    {
        $coaSubs = CoaSub::with('coaMain')->get();
        return view('coa_subs.index', compact('coaSubs'));
    }

    public function create()
    {
        $coaMains = CoaMain::pluck('title', 'id');
        return view('coa_subs.create', compact('coaMains'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'coa_main_id' => 'required|exists:coa_mains,id',
            'status' => 'required|in:active,inactive',
        ]);

        CoaSub::create($request->all());

        return redirect()->route('coa-subs.index')->with('success', 'CoaSub created successfully.');
    }

    public function show(CoaSub $coaSub)
    {
        return view('coa_subs.show', compact('coaSub'));
    }

    public function edit(CoaSub $coaSub)
    {
        $coaMains = CoaMain::pluck('title', 'id');
        return view('coa_subs.edit', compact('coaSub', 'coaMains'));
    }

    public function update(Request $request, CoaSub $coaSub)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'coa_main_id' => 'required|exists:coa_mains,id',
            'status' => 'required|in:active,inactive',
        ]);

        $coaSub->update($request->all());

        return redirect()->route('coa-subs.index')->with('success', 'CoaSub updated successfully.');
    }

    public function destroy(CoaSub $coaSub)
    {
        $coaSub->delete();
        return redirect()->route('coa-subs.index')->with('success', 'CoaSub deleted successfully.');
    }
}
