<?php

namespace App\Http\Controllers;

use App\Models\Order;

class ReceiptController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Return a printable receipt view for the given order.
     * The browser handles printing via window.print() — no printer drivers needed.
     */
    public function print(int $orderId)
    {
        $order = Order::findOrFail($orderId);

        // Ensure the authenticated user owns this order
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load('items.product');

        return view('checkout.receipt', compact('order'));
    }
}
