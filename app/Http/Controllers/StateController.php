<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Models\Country;
use Illuminate\Http\Request;

class StateController extends Controller
{
    /**
     * Display a listing of states.
     */
    public function index()
    {
        // $states = State::with('country')->get();
        $states = State::select('id', 'title', 'country_id', 'status')
        ->with(['country:id,title']) // only fetch id + title of country
        ->get();
        // dd($states);
        return view('states.index', compact('states'));
    }

    /**
     * Show the form for creating a new state.
     */
    public function create()
    {
        $countries = Country::all();
        return view('states.create', compact('countries'));
    }

    /**
     * Store a newly created state in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'      => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'status'     => 'required|boolean',
        ]);

        State::create($request->all());

        return redirect()->route('states.index')
            ->with('success', 'State created successfully.');
    }

    /**
     * Show the form for editing the specified state.
     */
    public function edit(State $state)
    {
        $countries = Country::all();
        return view('states.edit', compact('state', 'countries'));
    }

    /**
     * Update the specified state in storage.
     */
    public function update(Request $request, State $state)
    {
        $request->validate([
            'title'      => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'status'     => 'required|boolean',
        ]);

        $state->update($request->all());

        return redirect()->route('states.index')
            ->with('success', 'State updated successfully.');
    }

    /**
     * Remove the specified state from storage.
     */
    public function destroy(State $state)
    {
        $state->delete();

        return redirect()->route('states.index')
            ->with('success', 'State deleted successfully.');
    }
}
