<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\PaymentIntent;
use Exception;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    /**
     * Show checkout page with payment method selection
     */
    public function showCheckout()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $cartRaw = session()->get('cart', []);

        if (empty($cartRaw)) {
            return redirect()->route('cart.index')->with('error', 'El carrito está vacío');
        }

        // Merge fresh product data from DB
        $cart = [];
        $total = 0;

        foreach ($cartRaw as $id => $item) {
            $product = Product::find($id);
            if ($product) {
                $cart[$id] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'image' => $product->image ?? null,
                    'quantity' => $item['quantity'],
                ];
                $total += $product->price * $item['quantity'];
            }
        }

        return view('checkout.index', compact('cart', 'total'));
    }

    /**
     * Show Stripe payment form
     */
    public function showStripeCheckout()
    {
        $cartRaw = session()->get('cart', []);

        if (empty($cartRaw)) {
            return redirect()->route('cart.index')->with('error', 'El carrito está vacío');
        }

        $total = $this->calculateTotal($cartRaw);

        return view('checkout.stripe', compact('total'));
    }

    /**
     * Create Stripe Payment Intent
     */
    public function createStripeIntent(Request $request)
    {
        try {
            $cartRaw = session()->get('cart', []);

            if (empty($cartRaw)) {
                return response()->json(['error' => 'Cart is empty'], 400);
            }

            $amount = $this->calculateTotal($cartRaw);

            // Create payment intent
            $intent = PaymentIntent::create([
                'amount' => round($amount * 100), // Convert to cents
                'currency' => 'usd',
                'metadata' => [
                    'user_id' => auth()->id(),
                    'items_count' => count($cartRaw),
                ]
            ]);

            return response()->json([
                'success' => true,
                'clientSecret' => $intent->client_secret,
                'amount' => $amount,
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Process Stripe payment after confirmation
     */
    public function processStripePayment(Request $request)
    {
        try {
            $cartRaw = session()->get('cart', []);

            if (empty($cartRaw)) {
                return response()->json(['error' => 'Cart is empty'], 400);
            }

            $amount = $this->calculateTotal($cartRaw);

            // Create order
            $order = Order::create([
                'user_id' => auth()->id(),
                'total_amount' => $amount,
                'payment_method' => 'stripe',
                'payment_status' => 'pending',
                'transaction_id' => $request->payment_intent_id ?? null,
            ]);

            // Add items to order
            foreach ($cartRaw as $productId => $item) {
                $product = Product::find($productId);
                if ($product) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $productId,
                        'quantity' => $item['quantity'],
                        'price' => $product->price,
                        'total' => $product->price * $item['quantity'],
                    ]);
                }
            }

            // Update payment status
            $order->update(['payment_status' => 'completed']);

            // Clear cart
            session()->forget('cart');

            return response()->json([
                'success' => true,
                'order_id' => $order->id,
                'message' => 'Pago procesado correctamente',
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Show PayPal payment form
     */
    public function showPayPalCheckout()
    {
        $cartRaw = session()->get('cart', []);

        if (empty($cartRaw)) {
            return redirect()->route('cart.index')->with('error', 'El carrito está vacío');
        }

        $total = $this->calculateTotal($cartRaw);

        return view('checkout.paypal', compact('total'));
    }

    /**
     * Process PayPal payment
     */
    public function processPayPalPayment(Request $request)
    {
        try {
            $cartRaw = session()->get('cart', []);

            if (empty($cartRaw)) {
                return response()->json(['error' => 'Cart is empty'], 400);
            }

            $amount = $this->calculateTotal($cartRaw);

            // Create order
            $order = Order::create([
                'user_id' => auth()->id(),
                'total_amount' => $amount,
                'payment_method' => 'paypal',
                'payment_status' => 'completed',
                'transaction_id' => $request->transaction_id ?? 'PAYPAL_' . uniqid(),
            ]);

            // Add items to order
            foreach ($cartRaw as $productId => $item) {
                $product = Product::find($productId);
                if ($product) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $productId,
                        'quantity' => $item['quantity'],
                        'price' => $product->price,
                        'total' => $product->price * $item['quantity'],
                    ]);
                }
            }

            // Clear cart
            session()->forget('cart');

            return response()->json([
                'success' => true,
                'order_id' => $order->id,
                'message' => 'Pago procesado correctamente',
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Show bank transfer payment form
     */
    public function showBankCheckout()
    {
        $cartRaw = session()->get('cart', []);

        if (empty($cartRaw)) {
            return redirect()->route('cart.index')->with('error', 'El carrito está vacío');
        }

        $total = $this->calculateTotal($cartRaw);
        $bankReference = strtoupper(substr('ORD' . time() . rand(1000, 9999), 0, 16));

        return view('checkout.bank', compact('total', 'bankReference'));
    }

    /**
     * Process bank transfer payment
     */
    public function processBankPayment(Request $request)
    {
        try {
            $cartRaw = session()->get('cart', []);

            if (empty($cartRaw)) {
                return response()->json(['error' => 'Cart is empty'], 400);
            }

            $amount = $this->calculateTotal($cartRaw);

            // Create order
            $order = Order::create([
                'user_id' => auth()->id(),
                'total_amount' => $amount,
                'payment_method' => 'bank_transfer',
                'payment_status' => 'pending',
                'bank_reference' => $request->bank_reference,
                'notes' => 'Pending bank transfer confirmation',
            ]);

            // Add items to order
            foreach ($cartRaw as $productId => $item) {
                $product = Product::find($productId);
                if ($product) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $productId,
                        'quantity' => $item['quantity'],
                        'price' => $product->price,
                        'total' => $product->price * $item['quantity'],
                    ]);
                }
            }

            // Clear cart
            session()->forget('cart');

            return response()->json([
                'success' => true,
                'order_id' => $order->id,
                'bank_reference' => $order->bank_reference,
                'message' => 'Orden creada. Por favor, realiza la transferencia bancaria.',
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * View order confirmation
     */
    public function confirmation($orderId)
    {
        $order = Order::findOrFail($orderId);

        // Ensure user owns this order
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load('items.product');

        return view('checkout.confirmation', compact('order'));
    }

    /**
     * Calculate total from cart
     */
    private function calculateTotal($cart)
    {
        $total = 0;
        foreach ($cart as $id => $item) {
            $product = Product::find($id);
            if ($product) {
                $total += $product->price * $item['quantity'];
            }
        }
        return $total;
    }

    /**
     * User's orders list
     */
    public function myOrders()
    {
        $orders = Order::where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('checkout.my-orders', compact('orders'));
    }
}
