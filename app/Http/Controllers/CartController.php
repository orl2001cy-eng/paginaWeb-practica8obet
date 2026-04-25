<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Show the cart page.
     */
    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $cartRaw = session()->get('cart', []);

        // Merge fresh product data (name, price, image) from DB
        $cart = [];
        foreach ($cartRaw as $id => $item) {
            $product = \App\Models\Product::find($id);
            if ($product) {
                $cart[$id] = [
                    'id'       => $product->id,
                    'name'     => $product->name,
                    'price'    => $product->price,
                    'image'    => $product->image ?? null,
                    'quantity' => $item['quantity'],
                ];
            }
        }

        // Keep cart in sync with DB
        session()->put('cart', $cart);

        // Fetch latest 3 orders for purchase history preview
        $recentOrders = Order::where('user_id', auth()->id())
            ->with('items.product')
            ->latest()
            ->take(3)
            ->get();

        return view('cart.index', compact('cart', 'recentOrders'));
    }

    /**
     * Add a product to the session cart.
     * Requires authentication — checked here so we can return JSON.
     */
    public function add(Request $request, $productId)
    {
        if (!auth()->check()) {
            return response()->json([
                'authenticated' => false,
                'redirect'      => route('login'),
            ], 401);
        }

        $product = Product::findOrFail($productId);

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                'id'       => $product->id,
                'name'     => $product->name,
                'price'    => $product->price,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'authenticated' => true,
            'count'         => array_sum(array_column($cart, 'quantity')),
            'message'       => "\"{$product->name}\" añadido al carrito.",
        ]);
    }

    /**
     * Remove ALL units of a product from the cart (trash button).
     */
    public function removeAll(Request $request, $productId)
    {
        $cart = session()->get('cart', []);
        unset($cart[$productId]);
        session()->put('cart', $cart);

        return response()->json([
            'count' => array_sum(array_column($cart, 'quantity')),
        ]);
    }

    /**
     * Remove one unit of a product from the cart.
     */
    public function remove(Request $request, $productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            if ($cart[$productId]['quantity'] > 1) {
                $cart[$productId]['quantity']--;
            } else {
                unset($cart[$productId]);
            }
            session()->put('cart', $cart);
        }

        return response()->json([
            'count' => array_sum(array_column($cart, 'quantity')),
        ]);
    }

    /**
     * Clear all items from the cart.
     */
    public function clear()
    {
        session()->forget('cart');
        return response()->json(['count' => 0]);
    }

    /**
     * Return the current cart count (used for page refresh sync).
     */
    public function count()
    {
        $cart = session()->get('cart', []);
        return response()->json([
            'count' => array_sum(array_column($cart, 'quantity')),
        ]);
    }
}
