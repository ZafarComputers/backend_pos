<?php

namespace App\Http\Controllers;

use App\Models\PosReturn;
use Illuminate\Http\Request;

class PosReturnController extends Controller
{
    // WEB INDEX
    public function index()
    {
        $returns = PosReturn::with('customer')->paginate(10);
        return view('pos_returns.index', compact('returns'));
    }

    // API INDEX
    public function apiIndex()
    {
        return response()->json(PosReturn::with('customer')->get());
    }

    public function create()
    {
        return view('pos_returns.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'invRet_date' => 'required|date',
            'pos_inv_no' => 'required|string|max:50',
            'return_inv_amout' => 'required|numeric|min:0',
        ]);

        $posReturn = PosReturn::create($data);

        if ($request->wantsJson()) {
            return response()->json(['message' => 'POS Return created', 'data' => $posReturn]);
        }

        return redirect()->route('pos_returns.index')->with('success', 'POS Return created successfully.');
    }

    public function show($id)
    {
        return response()->json(PosReturn::with('customer')->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'invRet_date' => 'required|date',
            'pos_inv_no' => 'required|string|max:50',
            'return_inv_amout' => 'required|numeric|min:0',
        ]);

        $posReturn = PosReturn::findOrFail($id);
        $posReturn->update($data);

        return response()->json(['message' => 'POS Return updated', 'data' => $posReturn]);
    }

    public function destroy($id)
    {
        $posReturn = PosReturn::findOrFail($id);
        $posReturn->delete();

        return response()->json(['message' => 'POS Return deleted']);
    }
}
