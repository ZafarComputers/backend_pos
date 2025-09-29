<?php

namespace App\Http\Controllers;

use App\Models\Pos;
use Illuminate\Http\Request;

class PosController extends Controller
{
    // Web index
    public function index()
    {
        $pos = Pos::with('customer')->paginate(10);
        return view('pos.index', compact('pos'));
    }

    // API index
    public function apiIndex()
    {
        return response()->json(Pos::with('customer')->get());
    }

    public function create()
    {
        return view('pos.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'inv_date' => 'required|date',
            'inv_amout' => 'required|numeric|min:0',
            'tax' => 'nullable|numeric|min:0',
            'discPer' => 'nullable|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
        ]);

        Pos::create($data);

        return redirect()->route('pos.index')->with('success', 'POS Invoice created successfully.');
    }


public function show($id)
{
    $pos = Pos::with('customer')->findOrFail($id);
    return response()->json($pos);
}

public function update(Request $request, $id)
{
    $data = $request->validate([
        'customer_id' => 'required|exists:customers,id',
        'inv_date' => 'required|date',
        'inv_amout' => 'required|numeric|min:0',
        'tax' => 'nullable|numeric|min:0',
        'discPer' => 'nullable|numeric|min:0',
        'discount' => 'nullable|numeric|min:0',
    ]);

    $pos = Pos::findOrFail($id);
    $pos->update($data);

    return response()->json(['message' => 'Invoice updated', 'data' => $pos]);
}

public function destroy($id)
{
    $pos = Pos::findOrFail($id);
    $pos->delete();

    return response()->json(['message' => 'Invoice deleted']);
}

}
