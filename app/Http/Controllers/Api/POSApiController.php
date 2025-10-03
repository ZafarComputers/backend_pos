<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class POSApiController extends Controller
{
    // Get products by category or all
    public function products(Request $request)
    {
        $categoryId = $request->query('category_id'); // optional

        $query = Product::query();

        if ($categoryId) {
            $query->where('sub_category_id', $categoryId);
        }

        $products = $query->where('status', 'Active')->get();

        return ProductResource::collection($products);
    }

    // Show current cart
    public function cart()
    {
        $cart = Session::get('pos_cart', []);
        return response()->json($cart);
    }

    // Add product to cart
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1'
        ]);

        $cart = Session::get('pos_cart', []);

        $product = Product::findOrFail($request->product_id);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $request->quantity;
        } else {
            $cart[$product->id] = [
                'id'       => $product->id,
                'title'    => $product->title,
                'price'    => $product->sale_price,
                'quantity' => $request->quantity,
            ];
        }

        Session::put('pos_cart', $cart);

        return response()->json(['message' => 'Product added to cart', 'cart' => $cart]);
    }

    // Update quantity of product in cart
    public function updateCart(Request $request, $productId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = Session::get('pos_cart', []);

        if (!isset($cart[$productId])) {
            return response()->json(['message' => 'Product not found in cart'], 404);
        }

        $cart[$productId]['quantity'] = $request->quantity;

        Session::put('pos_cart', $cart);

        return response()->json(['message' => 'Cart updated', 'cart' => $cart]);
    }

    // Remove product from cart
    public function removeFromCart($productId)
    {
        $cart = Session::get('pos_cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            Session::put('pos_cart', $cart);
        }

        return response()->json(['message' => 'Product removed', 'cart' => $cart]);
    }
}
