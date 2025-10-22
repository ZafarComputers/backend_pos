<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\State;

class StateController extends Controller
{
    public function index()
    {
        return response()->json(State::with('country')->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'      => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'status'     => 'required|in:active,inactive',
        ]);

        $state = State::create($data);

        return response()->json($state, 201);
    }

    public function show(State $state)
    {
        return response()->json($state->load('country'));
    }

    public function update(Request $request, State $state)
    {
        $data = $request->validate([
            'title'      => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'status'     => 'required|in:active,inactive',
        ]);

        $state->update($data);

        return response()->json($state);
    }

    public function destroy(State $state)
    {
        $state->delete();
        return response()->json(['message' => 'State deleted']);
    }
}
