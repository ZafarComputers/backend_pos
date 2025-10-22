<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Cache;
use App\Models\Product;

class PosCartController extends Controller
{
    use ApiResponse;
    
    private function getCartKey($userId)
    {
        return "pos_cart_{$userId}";
    }
    
    /**
     * Get current cart items
     */
    public function getCart(Request $request)
    {
        $cartKey = $this->getCartKey($request->user()->id);
        $cart = Cache::get($cartKey, []);
        
        $cartWithDetails = [];
        $totalAmount = 0;
        
        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);
            if ($product) {
                $itemTotal = $product->sale_price * $item['quantity'];
                $cartWithDetails[] = [
                    'product_id' => $productId,
                    'product' => [
                        'id' => $product->id,
                        'name' => $product->name,
                        'sale_price' => $product->sale_price,
                        'stock' => $product->stock,
                    ],
                    'quantity' => $item['quantity'],
                    'unit_price' => $product->sale_price,
                    'total_price' => $itemTotal,
                ];
                $totalAmount += $itemTotal;
            }
        }
        
        return $this->success([
            'items' => $cartWithDetails,
            'total_amount' => $totalAmount,
            'total_items' => count($cartWithDetails)
        ], 'Cart retrieved successfully');
    }
    
    /**
     * Add item to cart
     */
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);
        
        $product = Product::find($request->product_id);
        
        // Check stock availability
        if ($product->stock < $request->quantity) {
            return $this->error('Insufficient stock. Available: ' . $product->stock);
        }
        
        $cartKey = $this->getCartKey($request->user()->id);
        $cart = Cache::get($cartKey, []);
        
        // Add or update item in cart
        if (isset($cart[$request->product_id])) {
            $newQuantity = $cart[$request->product_id]['quantity'] + $request->quantity;
            
            // Check total quantity against stock
            if ($product->stock < $newQuantity) {
                return $this->error('Insufficient stock for total quantity. Available: ' . $product->stock);
            }
            
            $cart[$request->product_id]['quantity'] = $newQuantity;
        } else {
            $cart[$request->product_id] = [
                'quantity' => $request->quantity,
                'added_at' => now()->timestamp
            ];
        }
        
        // Cache for 1 hour
        Cache::put($cartKey, $cart, 3600);
        
        return $this->success(null, 'Item added to cart successfully');
    }
    
    /**
     * Update item quantity in cart
     */
    public function updateCartItem(Request $request, $productId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);
        
        $product = Product::find($productId);
        if (!$product) {
            return $this->notFound('Product not found');
        }
        
        // Check stock availability
        if ($product->stock < $request->quantity) {
            return $this->error('Insufficient stock. Available: ' . $product->stock);
        }
        
        $cartKey = $this->getCartKey($request->user()->id);
        $cart = Cache::get($cartKey, []);
        
        if (!isset($cart[$productId])) {
            return $this->notFound('Item not found in cart');
        }
        
        $cart[$productId]['quantity'] = $request->quantity;
        Cache::put($cartKey, $cart, 3600);
        
        return $this->success(null, 'Cart item updated successfully');
    }
    
    /**
     * Remove item from cart
     */
    public function removeFromCart(Request $request, $productId)
    {
        $cartKey = $this->getCartKey($request->user()->id);
        $cart = Cache::get($cartKey, []);
        
        if (!isset($cart[$productId])) {
            return $this->notFound('Item not found in cart');
        }
        
        unset($cart[$productId]);
        Cache::put($cartKey, $cart, 3600);
        
        return $this->success(null, 'Item removed from cart successfully');
    }
    
    /**
     * Clear entire cart
     */
    public function clearCart(Request $request)
    {
        $cartKey = $this->getCartKey($request->user()->id);
        Cache::forget($cartKey);
        
        return $this->success(null, 'Cart cleared successfully');
    }
    
    /**
     * Apply discount to cart
     */
    public function applyDiscount(Request $request)
    {
        $request->validate([
            'discount_type' => 'required|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:0',
        ]);
        
        $cartKey = $this->getCartKey($request->user()->id);
        $cart = Cache::get($cartKey, []);
        
        // Add discount info to cart
        $cart['_discount'] = [
            'type' => $request->discount_type,
            'value' => $request->discount_value,
        ];
        
        Cache::put($cartKey, $cart, 3600);
        
        return $this->success(null, 'Discount applied successfully');
    }
}
