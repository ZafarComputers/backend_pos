<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Web index
    public function index()
    {
        $products = Product::with('subCategory')->paginate(10);
        return view('products.index', compact('products'));
    }

    // API index
    public function apiIndex()
    {
        return response()->json(Product::with('subCategory')->get());
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'design_code' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'sale_price' => 'required|numeric|min:0',
            'opening_stock_quantity' => 'required|integer|min:0',
            'user_id' => 'required|exists:users,id',
            'barcode' => 'nullable|string|unique:products',
            'status' => 'required|in:Active,Inactive',
        ]);

        // ✅ Handle Image Upload
        if ($request->hasFile('image')) {
            $fileName = time().'_'.$request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('products', $fileName, 'public');
            $data['image_path'] = $path; // store only relative path
        }

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

}
