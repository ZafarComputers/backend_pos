<?php

namespace App\Http\Controllers;

use App\Models\Pos;
use Illuminate\Http\Request;

class PosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pos = Pos::with('posDetails')->get();
        return view('pos.index', compact('pos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Assuming you have customers and products available
        $customers = Customer::all();
        $products = Product::all();
        return view('pos.create', compact('customers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'inv_date' => 'required|date',
            'inv_amount' => 'required|numeric',
            'tax' => 'numeric',
            'disc_per' => 'numeric',
            'discount' => 'numeric',
            'reason' => 'nullable|string',
            'details.*.product_id' => 'required|exists:products,id',
            'details.*.qty' => 'required|integer|min:1',
            'details.*.sale_price' => 'required|numeric',
        ]);

        $pos = Pos::create($request->only(['customer_id', 'inv_date', 'inv_amount', 'tax', 'disc_per', 'reason', 'discount']));

        foreach ($validated['details'] as $detail) {
            $pos->posDetails()->create($detail);
        }

        return redirect()->route('pos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pos $pos)
    {
        $pos->load('posDetails');
        return view('pos.show', compact('pos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pos $pos)
    {
        $pos->load('posDetails');
        $customers = Customer::all();
        $products = Product::all();
        return view('pos.edit', compact('pos', 'customers', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pos $pos)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'inv_date' => 'required|date',
            'inv_amount' => 'required|numeric',
            'tax' => 'numeric',
            'reason' => 'nullable|string',
            'disc_per' => 'numeric',
            'discount' => 'numeric',
            'details.*.product_id' => 'required|exists:products,id',
            'details.*.qty' => 'required|integer|min:1',
            'details.*.sale_price' => 'required|numeric',
        ]);

        $pos->update($request->only(['customer_id', 'inv_date', 'inv_amount', 'tax', 'disc_per', 'reason', 'discount']));

        $pos->posDetails()->delete();
        foreach ($validated['details'] as $detail) {
            $pos->posDetails()->create($detail);
        }

        return redirect()->route('pos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pos $pos)
    {
        $pos->delete();
        return redirect()->route('pos.index');
    }
}