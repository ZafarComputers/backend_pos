<?php

namespace App\Http\Controllers\Api;

use App\Models\PosDetail;
use Illuminate\Http\Request;

class PosDetailApiController extends Controller
{
    // Web index
    public function index()
    {
        $details = PosDetail::with(['pos', 'product'])->paginate(10);
        return view('pos_details.index', compact('details'));
    }

    // API index
    public function apiIndex()
    {
        return response()->json(PosDetail::with(['pos','product'])->get());
    }

    public function create()
    {
        return view('pos_details.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'pos_id' => 'required|exists:pos,id',
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric|min:0',
        ]);

        $detail = PosDetail::create($data);

        if ($request->wantsJson()) {
            return response()->json(['message' => 'POS Detail created', 'data' => $detail]);
        }

        return redirect()->route('pos_details.index')->with('success', 'POS Detail added successfully.');
    }

    public function show($id)
    {
        return response()->json(PosDetail::with(['pos','product'])->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'pos_id' => 'required|exists:pos,id',
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1',
            'sale_price' => 'required|numeric|min:0',
            'unit_price' => 'required|numeric|min:0',
        ]);

        $detail = PosDetail::findOrFail($id);
        $detail->update($data);

        return response()->json(['message' => 'POS Detail updated', 'data' => $detail]);
    }

    public function destroy($id)
    {
        $detail = PosDetail::findOrFail($id);
        $detail->delete();

        return response()->json(['message' => 'POS Detail deleted']);
    }
}
