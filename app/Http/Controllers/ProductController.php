<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['subCategory', 'user'])->paginate(10);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'design_code' => 'nullable|string',
            'image_path' => 'nullable|string',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'sale_price' => 'required|numeric',
            'opening_stock_quantity' => 'required|integer',
            'user_id' => 'required|exists:users,id',
            'barcode' => 'nullable|string',
            'status' => 'required|in:Active,Inactive',
        ]);

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'design_code' => 'nullable|string',
            'image_path' => 'nullable|string',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'sale_price' => 'required|numeric',
            'opening_stock_quantity' => 'required|integer',
            'user_id' => 'required|exists:users,id',
            'barcode' => 'nullable|string',
            'status' => 'required|in:Active,Inactive',
        ]);

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
