<!doctype html>
<html lang="es">
<head>
    <title>Mi Carrito – Obet's Store</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #8A9A86;
            --primary-dark: #6C7A68;
            --accent-color: #D4A373;
            --bg-gradient-start: #E9EFE6;
            --bg-gradient-end: #FDFBF7;
            --text-dark: #333333;
        }

        * { box-sizing: border-box; }

        body {
            background: linear-gradient(135deg, var(--bg-gradient-start) 0%, var(--bg-gradient-end) 100%);
            min-height: 100vh;
            padding-bottom: 3rem;
            font-family: 'Inter', sans-serif;
            color: var(--text-dark);
        }

        h1, h2, h3, .navbar-brand-custom {
            font-family: 'Playfair Display', serif;
        }

        /* ── Navbar ── */
        .store-nav { padding: 1rem 0; margin-bottom: 2rem; }

        .navbar-brand-custom {
            color: var(--primary-dark);
            font-size: 1.4rem;
            font-weight: 800;
            text-decoration: none;
        }
        .navbar-brand-custom:hover { color: var(--primary-color); }

        .btn-nav {
            background: rgba(138,154,134,0.1);
            backdrop-filter: blur(6px);
            border: 1.5px solid rgba(138,154,134,0.4);
            color: var(--primary-dark);
            border-radius: 25px;
            padding: 0.4rem 1.1rem;
            font-size: 0.88rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.25s;
            position: relative;
        }
        .btn-nav:hover { background: rgba(138,154,134,0.2); color: var(--primary-dark); }

        /* ── Page header ── */
        .page-header {
            text-align: center;
            color: var(--primary-dark);
            margin-bottom: 2rem;
        }
        .page-header h1 {
            font-size: 2.2rem;
            font-weight: 800;
        }
        .page-header p { color: var(--text-dark); }

        /* ── Cart card ── */
        .cart-card {
            background: white;
            border-radius: 18px;
            box-shadow: 0 15px 45px rgba(0,0,0,0.2);
            overflow: hidden;
        }

        /* ── Cart item row ── */
        .cart-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 1.4rem;
            border-bottom: 1px solid #f0f0f0;
            transition: background 0.2s;
            animation: fadeIn 0.4s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateX(-10px); }
            to   { opacity: 1; transform: translateX(0); }
        }

        .cart-item:last-child { border-bottom: none; }
        .cart-item:hover { background: #fafafe; }

        .item-img {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 12px;
            flex-shrink: 0;
        }

        .item-img-placeholder {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #e0e0e0, #f5f5f5);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 1.4rem;
            color: #aaa;
        }

        .item-info { flex: 1; }
        .item-name {
            font-weight: 700;
            font-size: 0.98rem;
            color: #2d2d2d;
            margin-bottom: 2px;
        }
        .item-price {
            font-size: 0.88rem;
            color: #667eea;
            font-weight: 600;
        }

        /* ── Quantity controls ── */
        .qty-control {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            flex-shrink: 0;
        }

        .qty-btn {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            border: 2px solid var(--primary-color);
            background: white;
            color: var(--primary-color);
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
            padding: 0;
            line-height: 1;
        }
        .qty-btn:hover {
            background: var(--primary-color);
            color: white;
        }
        .qty-btn:disabled {
            opacity: 0.35;
            cursor: not-allowed;
        }

        .qty-value {
            min-width: 30px;
            text-align: center;
            font-weight: 700;
            font-size: 1rem;
            color: #2d2d2d;
        }

        /* ── Line total ── */
        .item-total {
            font-weight: 800;
            font-size: 1rem;
            color: #2d2d2d;
            min-width: 80px;
            text-align: right;
            flex-shrink: 0;
        }

        /* ── Delete button ── */
        .btn-remove {
            background: none;
            border: none;
            color: #dc3545;
            font-size: 1.15rem;
            cursor: pointer;
            padding: 4px 8px;
            border-radius: 8px;
            transition: background 0.2s, color 0.2s;
            flex-shrink: 0;
        }
        .btn-remove:hover {
            background: #ffeaea;
        }

        /* ── Summary footer ── */
        .cart-summary {
            background: linear-gradient(135deg, #f8f9ff 0%, #f0f2ff 100%);
            border-top: 2px solid #e8ecff;
            padding: 1.4rem 1.8rem;
            border-radius: 0 0 18px 18px;
        }

        .total-label {
            font-size: 1rem;
            font-weight: 700;
            color: #555;
        }

        .total-amount {
            font-size: 1.6rem;
            font-weight: 900;
            color: var(--primary-dark);
        }

        /* ── Action buttons ── */
        .btn-checkout {
            background: var(--primary-color);
            border: none;
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.95rem;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }
        .btn-checkout:hover {
            transform: translateY(-2px);
            background: var(--primary-dark);
            box-shadow: 0 8px 20px rgba(138,154,134,0.45);
            color: white;
        }

        .btn-clear {
            background: none;
            border: 2px solid #dc3545;
            color: #dc3545;
            padding: 0.65rem 1.5rem;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.88rem;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-clear:hover {
            background: #dc3545;
            color: white;
        }

        .btn-continue {
            background: rgba(255,255,255,0.9);
            border: 2px solid var(--primary-color);
            color: var(--primary-dark);
            padding: 0.65rem 1.5rem;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.88rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            transition: all 0.2s;
        }
        .btn-continue:hover {
            background: var(--primary-color);
            color: white;
        }

        /* ── Empty cart ── */
        .empty-cart {
            text-align: center;
            padding: 4rem 2rem;
            background: white;
            border-radius: 18px;
            box-shadow: 0 15px 45px rgba(0,0,0,0.2);
        }
        .empty-cart i {
            font-size: 5rem;
            color: #667eea;
            margin-bottom: 1rem;
        }
        .empty-cart h2 { color: #2d2d2d; font-weight: 800; }
        .empty-cart p  { color: #888; }

        /* ── Toast ── */
        .cart-toast {
            position: fixed;
            bottom: 1.5rem;
            right: 1.5rem;
            z-index: 1100;
            min-width: 240px;
            border-radius: 12px;
            animation: slideUp 0.3s ease;
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* Cart badge */
        #cart-badge {
            position: absolute;
            top: -7px;
            right: -8px;
            font-size: 0.65rem;
            min-width: 17px;
            height: 17px;
            line-height: 17px;
            padding: 0 4px;
            border-radius: 50px;
            background: var(--accent-color);
            color: white;
            text-align: center;
        }

        /* ── Purchase History Section ── */
        .history-section {
            margin-top: 2.5rem;
        }

        .history-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.2rem;
        }

        .history-title {
            color: white;
            font-size: 1.4rem;
            font-weight: 800;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.25);
            margin: 0;
        }

        .btn-view-all {
            background: rgba(255,255,255,0.22);
            backdrop-filter: blur(6px);
            border: 1.5px solid rgba(255,255,255,0.5);
            color: white;
            border-radius: 50px;
            padding: 0.4rem 1.1rem;
            font-size: 0.83rem;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.25s;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
        }
        .btn-view-all:hover {
            background: rgba(255,255,255,0.4);
            color: white;
            transform: translateY(-2px);
        }

        .history-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.18);
            overflow: hidden;
            margin-bottom: 1rem;
            transition: transform 0.2s, box-shadow 0.2s;
            animation: fadeIn 0.4s ease;
        }
        .history-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 16px 40px rgba(0,0,0,0.22);
        }

        .history-card-header {
            background: linear-gradient(135deg, rgba(102,126,234,0.08), rgba(118,75,162,0.08));
            padding: 0.9rem 1.3rem;
            border-bottom: 1.5px solid #f0f0f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .history-order-num {
            font-weight: 800;
            font-size: 0.95rem;
            color: #2d2d2d;
        }

        .history-order-date {
            font-size: 0.8rem;
            color: #888;
            margin-top: 1px;
        }

        .h-status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            padding: 0.3rem 0.75rem;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.72rem;
            white-space: nowrap;
        }
        .h-status-completed { background: #d4edda; color: #155724; }
        .h-status-pending   { background: #fff3cd; color: #856404; }
        .h-status-failed    { background: #f8d7da; color: #721c24; }
        .h-status-review    { background: #e3f2fd; color: #1565c0; }

        .history-card-body {
            padding: 0.85rem 1.3rem;
        }

        .h-item-line {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.88rem;
            padding: 0.3rem 0;
            border-bottom: 1px solid #f5f5f5;
            color: #444;
        }
        .h-item-line:last-child { border-bottom: none; }
        .h-item-name { flex: 1; }
        .h-item-qty  { color: #667eea; font-weight: 600; margin: 0 0.75rem; font-size: 0.82rem; }
        .h-item-price { font-weight: 700; color: #2d2d2d; }

        .history-card-footer {
            background: linear-gradient(135deg, #f8f9ff, #f0f2ff);
            border-top: 1.5px solid #e8ecff;
            padding: 0.75rem 1.3rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .h-total {
            font-weight: 800;
            font-size: 1.05rem;
            color: var(--primary-dark);
        }

        .btn-h-detail {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            transition: all 0.2s;
        }
        .btn-h-detail:hover {
            transform: scale(1.04);
            box-shadow: 0 4px 14px rgba(138,154,134,0.4);
            background: var(--primary-dark);
            color: white;
        }

        .history-empty {
            text-align: center;
            background: white;
            border-radius: 16px;
            padding: 2.5rem 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            color: #888;
        }
        .history-empty i { font-size: 2.5rem; color: #c0c8f7; margin-bottom: 0.8rem; display: block; }
        .history-empty p { margin: 0; font-size: 0.92rem; }
    </style>
</head>
<body>
    {{-- Navbar --}}
    <nav class="store-nav">
        <div class="container d-flex align-items-center justify-content-between">
            <a class="navbar-brand-custom" href="/">
                <i class="bi bi-shop me-1"></i> Obet's Store
            </a>
            <div class="d-flex gap-2 align-items-center">
                {{-- Cart icon (active) --}}
                <a href="{{ route('cart.index') }}" class="btn-nav" style="background:rgba(255,255,255,0.35);" title="Mi carrito">
                    <i class="bi bi-cart3"></i>
                    @php $cartCount = collect(session('cart', []))->sum('quantity'); @endphp
                    @if($cartCount > 0)
                        <span id="cart-badge">{{ $cartCount }}</span>
                    @endif
                </a>
                <a href="{{ route('payment.my-orders') }}" class="btn-nav" title="Historial de compras">
                    <i class="bi bi-clock-history me-1"></i> Historial
                </a>
                <a href="{{ route('dashboard') }}" class="btn-nav">
                    <i class="bi bi-house-door me-1"></i> Dashboard
                </a>
                <a href="{{ route('logout') }}" class="btn-nav"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right me-1"></i> Salir
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
            </div>
        </div>
    </nav>

    <main>
        <div class="container" style="max-width:850px;">
            {{-- Header --}}
            <div class="page-header">
                <h1><i class="bi bi-cart3 me-2"></i>Mi Carrito</h1>
                <p>Revisa y gestiona los productos que has seleccionado</p>
            </div>

            @if($cart && count($cart) > 0)
                {{-- Cart items --}}
                <div class="cart-card mb-4" id="cart-container">
                    @foreach($cart as $id => $item)
                        <div class="cart-item" id="item-row-{{ $id }}">
                            {{-- Image --}}
                            @if(isset($item['image']) && \Illuminate\Support\Facades\Storage::disk('public')->exists($item['image']))
                                <img src="{{ asset('storage/' . $item['image']) }}" class="item-img" alt="{{ $item['name'] }}">
                            @else
                                <div class="item-img-placeholder">
                                    <i class="bi bi-image"></i>
                                </div>
                            @endif

                            {{-- Name & unit price --}}
                            <div class="item-info">
                                <div class="item-name">{{ $item['name'] }}</div>
                                <div class="item-price">${{ number_format($item['price'], 2) }} c/u</div>
                            </div>

                            {{-- Quantity controls --}}
                            <div class="qty-control">
                                <button class="qty-btn" onclick="changeQty({{ $id }}, -1)" title="Quitar uno">−</button>
                                <span class="qty-value" id="qty-{{ $id }}">{{ $item['quantity'] }}</span>
                                <button class="qty-btn" onclick="changeQty({{ $id }}, 1)" title="Agregar uno">+</button>
                            </div>

                            {{-- Line total --}}
                            <div class="item-total" id="total-{{ $id }}">
                                ${{ number_format($item['price'] * $item['quantity'], 2) }}
                            </div>

                            {{-- Delete --}}
                            <button class="btn-remove" onclick="removeItem({{ $id }})" title="Eliminar">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </div>
                    @endforeach
                </div>

                {{-- Summary & actions --}}
                <div class="cart-summary d-flex flex-column flex-sm-row align-items-center justify-content-between gap-3">
                    <div>
                        <div class="total-label">Total del carrito</div>
                        <div class="total-amount" id="grand-total">
                            ${{ number_format(collect($cart)->sum(fn($i) => $i['price'] * $i['quantity']), 2) }}
                        </div>
                    </div>
                    <div class="d-flex gap-2 flex-wrap justify-content-end">
                        <button class="btn-clear" onclick="clearCart()">
                            <i class="bi bi-trash me-1"></i> Vaciar carrito
                        </button>
                        <a href="/" class="btn-continue">
                            <i class="bi bi-arrow-left-circle"></i> Seguir comprando
                        </a>
                        <button class="btn-checkout" onclick="window.location.href='{{ route('payment.checkout') }}'">
                            <i class="bi bi-credit-card"></i> Proceder al pago
                        </button>
                    </div>
                </div>

            @else
                {{-- Empty state --}}
                <div class="empty-cart" id="empty-cart">
                    <i class="bi bi-cart-x"></i>
                    <h2>Tu carrito está vacío</h2>
                    <p class="mb-4">Aún no has agregado ningún producto. ¡Explora nuestra tienda!</p>
                    <a href="/" class="btn-checkout">
                        <i class="bi bi-bag-check me-1"></i> Ir a la tienda
                    </a>
                </div>
            @endif

            {{-- ══════════ Purchase History Section ══════════ --}}
            <div class="history-section">
                <div class="history-header">
                    <h2 class="history-title">
                        <i class="bi bi-clock-history me-2"></i>Historial de Compras
                    </h2>
                    <a href="{{ route('payment.my-orders') }}" class="btn-view-all">
                        <i class="bi bi-list-ul"></i> Ver historial completo
                    </a>
                </div>

                @if($recentOrders->count() > 0)
                    @foreach($recentOrders as $order)
                        <div class="history-card">
                            {{-- Card Header --}}
                            <div class="history-card-header">
                                <div>
                                    <div class="history-order-num">
                                        <i class="bi bi-receipt me-1" style="color:#667eea;"></i>
                                        Pedido #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}
                                    </div>
                                    <div class="history-order-date">
                                        {{ $order->created_at->format('d/m/Y H:i') }}
                                    </div>
                                </div>
                                <div class="d-flex gap-2 align-items-center flex-wrap">
                                    {{-- Payment status --}}
                                    @php
                                        $statusClass = match($order->payment_status) {
                                            'completed' => 'h-status-completed',
                                            'pending'   => 'h-status-pending',
                                            'failed'    => 'h-status-failed',
                                            default     => 'h-status-review',
                                        };
                                        $statusIcon = match($order->payment_status) {
                                            'completed' => 'bi-check-circle-fill',
                                            'pending'   => 'bi-clock-fill',
                                            'failed'    => 'bi-x-circle-fill',
                                            default     => 'bi-info-circle-fill',
                                        };
                                        $statusLabel = match($order->payment_status) {
                                            'completed' => 'Pagado',
                                            'pending'   => 'Pendiente',
                                            'failed'    => 'Fallido',
                                            default     => ucfirst($order->payment_status),
                                        };
                                    @endphp
                                    <span class="h-status-badge {{ $statusClass }}">
                                        <i class="bi {{ $statusIcon }}"></i> {{ $statusLabel }}
                                    </span>
                                    {{-- Payment method --}}
                                    <span class="h-status-badge h-status-review">
                                        @if($order->payment_method === 'stripe')
                                            <i class="bi bi-credit-card-fill"></i> Tarjeta
                                        @elseif($order->payment_method === 'paypal')
                                            <i class="bi bi-paypal"></i> PayPal
                                        @else
                                            <i class="bi bi-bank"></i> Banco
                                        @endif
                                    </span>
                                </div>
                            </div>

                            {{-- Card Body: items --}}
                            <div class="history-card-body">
                                @foreach($order->items->take(3) as $item)
                                    <div class="h-item-line">
                                        <span class="h-item-name">{{ $item->product->name ?? 'Producto eliminado' }}</span>
                                        <span class="h-item-qty">x{{ $item->quantity }}</span>
                                        <span class="h-item-price">${{ number_format($item->total, 2) }}</span>
                                    </div>
                                @endforeach
                                @if($order->items->count() > 3)
                                    <div style="font-size:0.8rem; color:#aaa; text-align:center; padding-top:0.4rem;">
                                        + {{ $order->items->count() - 3 }} producto(s) más…
                                    </div>
                                @endif
                            </div>

                            {{-- Card Footer --}}
                            <div class="history-card-footer">
                                <span class="h-total">Total: ${{ number_format($order->total_amount, 2) }}</span>
                                <a href="{{ route('payment.confirmation', ['orderId' => $order->id]) }}" class="btn-h-detail">
                                    <i class="bi bi-eye"></i> Ver detalles
                                </a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="history-empty">
                        <i class="bi bi-inbox"></i>
                        <p>Aún no tienes compras registradas. ¡Haz tu primera compra!</p>
                    </div>
                @endif
            </div>
            {{-- ════════════════════════════════════════════ --}}

        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script>
        const CSRF = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // ─── Cart state ───────────────────────────────────────────────
        // Prices indexed by product id (populated from PHP)
        const prices = @json(collect($cart)->mapWithKeys(fn($i, $id) => [$id => (float)$i['price']]));
        const quantities = @json(collect($cart)->mapWithKeys(fn($i, $id) => [$id => (int)$i['quantity']]));

        function fmtMoney(n) {
            return '$' + n.toLocaleString('en-US', {minimumFractionDigits:2, maximumFractionDigits:2});
        }

        function refreshGrandTotal() {
            let total = 0;
            Object.keys(quantities).forEach(id => {
                total += prices[id] * quantities[id];
            });
            const el = document.getElementById('grand-total');
            if (el) el.textContent = fmtMoney(total);
        }

        // ─── Change quantity (+1 / -1) ────────────────────────────────
        function changeQty(productId, delta) {
            const currentQty = quantities[productId] || 1;
            const newQty = currentQty + delta;

            if (newQty < 1) {
                removeItem(productId);
                return;
            }

            const url = delta > 0 ? `/cart/${productId}/add` : `/cart/${productId}/remove`;
            const method = delta > 0 ? 'POST' : 'DELETE';

            fetch(url, {
                method,
                headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
            })
            .then(r => r.json())
            .then(data => {
                quantities[productId] = newQty;

                const qtyEl   = document.getElementById(`qty-${productId}`);
                const totalEl = document.getElementById(`total-${productId}`);
                if (qtyEl)   qtyEl.textContent   = newQty;
                if (totalEl) totalEl.textContent  = fmtMoney(prices[productId] * newQty);

                updateNavBadge(data.count);
                refreshGrandTotal();
            })
            .catch(() => showToast('Error al actualizar cantidad.', 'danger'));
        }

        // ─── Remove item ──────────────────────────────────────────────
        function removeItem(productId) {
            fetch(`/cart/${productId}/remove-all`, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
            })
            .then(r => r.json())
            .then(data => {
                delete quantities[productId];
                delete prices[productId];

                const row = document.getElementById(`item-row-${productId}`);
                if (row) {
                    row.style.transition = 'opacity 0.3s, transform 0.3s';
                    row.style.opacity = '0';
                    row.style.transform = 'translateX(40px)';
                    setTimeout(() => { row.remove(); checkEmpty(); }, 320);
                }

                updateNavBadge(data.count);
                refreshGrandTotal();
            })
            .catch(() => showToast('Error al eliminar el producto.', 'danger'));
        }

        // ─── Clear cart ───────────────────────────────────────────────
        function clearCart() {
            if (!confirm('¿Estás seguro de que deseas vaciar el carrito?')) return;

            fetch('/cart/clear', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
            })
            .then(r => r.json())
            .then(data => {
                Object.keys(quantities).forEach(id => delete quantities[id]);
                Object.keys(prices).forEach(id => delete prices[id]);

                const container = document.getElementById('cart-container');
                if (container) {
                    container.style.transition = 'opacity 0.3s';
                    container.style.opacity = '0';
                    setTimeout(() => { container.remove(); checkEmpty(); }, 320);
                }

                const summary = document.querySelector('.cart-summary');
                if (summary) summary.remove();

                updateNavBadge(0);
            })
            .catch(() => showToast('Error al vaciar el carrito.', 'danger'));
        }

        // ─── Check if cart is empty (show empty state) ────────────────
        function checkEmpty() {
            if (Object.keys(quantities).length === 0) {
                const main = document.querySelector('.container');
                if (!document.getElementById('empty-cart')) {
                    main.innerHTML += `
                        <div class="empty-cart" id="empty-cart">
                            <i class="bi bi-cart-x" style="font-size:5rem;color:#667eea;margin-bottom:1rem;display:block;"></i>
                            <h2>Tu carrito está vacío</h2>
                            <p class="mb-4">Todos los productos han sido eliminados.</p>
                            <a href="/" class="btn-checkout" style="text-decoration:none;">
                                <i class="bi bi-bag-check me-1"></i> Ir a la tienda
                            </a>
                        </div>`;
                }
            }
        }

        // ─── Navbar badge ─────────────────────────────────────────────
        function updateNavBadge(count) {
            let badge = document.getElementById('cart-badge');
            const link = document.querySelector('a[href*="cart"]');
            if (count > 0) {
                if (!badge && link) {
                    badge = document.createElement('span');
                    badge.id = 'cart-badge';
                    link.appendChild(badge);
                }
                if (badge) badge.textContent = count;
            } else {
                if (badge) badge.remove();
            }
        }

        // ─── Toast ────────────────────────────────────────────────────
        function showToast(message, type = 'success') {
            document.querySelectorAll('.cart-toast').forEach(t => t.remove());
            const toast = document.createElement('div');
            toast.className = `alert alert-${type} shadow cart-toast`;
            toast.innerHTML = message;
            document.body.appendChild(toast);
            setTimeout(() => {
                toast.style.transition = 'opacity 0.4s';
                toast.style.opacity = '0';
                setTimeout(() => toast.remove(), 400);
            }, 2800);
        }
    </script>
</body>
</html>
