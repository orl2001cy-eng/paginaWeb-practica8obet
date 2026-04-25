<!doctype html>
<html lang="es">
<head>
    <title>Mis Pedidos – Obet's Store</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        * { box-sizing: border-box; }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding-bottom: 3rem;
            font-family: 'Segoe UI', sans-serif;
        }

        .navbar-brand-custom {
            color: white;
            font-size: 1.4rem;
            font-weight: 800;
            text-decoration: none;
        }

        .page-header {
            text-align: center;
            color: white;
            margin-bottom: 2rem;
        }

        .page-header h1 {
            font-size: 2rem;
            font-weight: 800;
        }

        .orders-container {
            max-width: 1000px;
        }

        .order-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            margin-bottom: 1.5rem;
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .order-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 35px rgba(0,0,0,0.2);
        }

        .order-header {
            background: linear-gradient(135deg, #667eea15, #764ba215);
            padding: 1.5rem;
            border-bottom: 2px solid #f0f0f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .order-number {
            font-weight: 700;
            font-size: 1.1rem;
            color: #2d2d2d;
        }

        .order-date {
            color: #666;
            font-size: 0.9rem;
        }

        .order-status {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .status-badge {
            display: inline-block;
            padding: 0.4rem 0.9rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.75rem;
            white-space: nowrap;
        }

        .status-completed {
            background: #d4edda;
            color: #155724;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-failed {
            background: #f8d7da;
            color: #721c24;
        }

        .order-body {
            padding: 1.5rem;
        }

        .items-list {
            margin-bottom: 1rem;
        }

        .item-line {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 0;
            border-bottom: 1px solid #f0f0f0;
            font-size: 0.95rem;
        }

        .item-line:last-child {
            border-bottom: none;
        }

        .item-info {
            flex: 1;
        }

        .item-qty {
            color: #666;
            margin: 0 1rem;
        }

        .item-price {
            font-weight: 700;
            color: #2d2d2d;
            text-align: right;
            min-width: 100px;
        }

        .order-footer {
            background: #f8f9ff;
            padding: 1.5rem;
            border-top: 2px solid #f0f0f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .total-amount {
            font-size: 1.3rem;
            font-weight: 800;
            color: #667eea;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .btn-action {
            padding: 0.5rem 1rem;
            border-radius: 8px;
            border: none;
            font-weight: 600;
            font-size: 0.85rem;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            transition: all 0.2s;
        }

        .btn-view {
            background: #667eea;
            color: white;
        }

        .btn-view:hover {
            background: #5568d3;
            color: white;
        }

        .empty-message {
            text-align: center;
            background: white;
            border-radius: 15px;
            padding: 3rem;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .empty-message i {
            font-size: 3rem;
            color: #667eea;
            margin-bottom: 1rem;
            display: block;
        }

        .empty-message h3 {
            color: #2d2d2d;
            font-weight: 800;
            margin-bottom: 0.5rem;
        }

        .empty-message p {
            color: #666;
            margin-bottom: 1.5rem;
        }

        .btn-shop {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            padding: 0.7rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            transition: all 0.2s;
        }

        .btn-shop:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102,126,234,0.45);
            color: white;
        }

        .pagination {
            margin-top: 2rem;
        }

        .page-item.active .page-link {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-color: #667eea;
        }

        .page-link {
            color: #667eea;
        }

        .page-link:hover {
            color: #764ba2;
        }
    </style>
</head>
<body>
    {{-- Navbar --}}
    <nav style="padding: 1rem 0; margin-bottom: 2rem;">
        <div class="container d-flex align-items-center justify-content-between">
            <a class="navbar-brand-custom" href="/">
                <i class="bi bi-shop me-1"></i> Obet's Store
            </a>
            <a href="/" style="color: white; text-decoration: none; font-weight: 600;">
                <i class="bi bi-arrow-left me-1"></i> Volver
            </a>
        </div>
    </nav>

    <main>
        <div class="container orders-container">
            <div class="page-header">
                <h1><i class="bi bi-list-check me-2"></i>Mis Pedidos</h1>
                <p>Historial y estado de tus compras</p>
            </div>

            @if($orders->count() > 0)
                @foreach($orders as $order)
                    <div class="order-card">
                        {{-- Order Header --}}
                        <div class="order-header">
                            <div>
                                <div class="order-number">Pedido #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</div>
                                <div class="order-date">{{ $order->created_at->format('d de F de Y \a \l\a\s H:i') }}</div>
                            </div>
                            <div class="order-status">
                                <span class="status-badge status-{{ $order->payment_status }}">
                                    @if($order->payment_status === 'completed')
                                        <i class="bi bi-check-circle me-1"></i>Pagado
                                    @elseif($order->payment_status === 'pending')
                                        <i class="bi bi-clock-history me-1"></i>Pendiente
                                    @elseif($order->payment_status === 'failed')
                                        <i class="bi bi-x-circle me-1"></i>Fallido
                                    @else
                                        {{ ucfirst($order->payment_status) }}
                                    @endif
                                </span>
                                <span class="status-badge" style="background: #e3f2fd; color: #1565c0;">
                                    @if($order->payment_method === 'stripe')
                                        <i class="bi bi-credit-card me-1"></i>Tarjeta
                                    @elseif($order->payment_method === 'paypal')
                                        <i class="bi bi-paypal me-1"></i>PayPal
                                    @else
                                        <i class="bi bi-bank me-1"></i>Banco
                                    @endif
                                </span>
                            </div>
                        </div>

                        {{-- Order Body --}}
                        <div class="order-body">
                            <div class="items-list">
                                @foreach($order->items as $item)
                                    <div class="item-line">
                                        <span class="item-info">{{ $item->product->name }}</span>
                                        <span class="item-qty">x{{ $item->quantity }}</span>
                                        <span class="item-price">${{ number_format($item->total, 2) }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Order Footer --}}
                        <div class="order-footer">
                            <div class="total-amount">Total: ${{ number_format($order->total_amount, 2) }}</div>
                            <div class="action-buttons">
                                <a href="{{ route('payment.confirmation', ['orderId' => $order->id]) }}" class="btn-action btn-view">
                                    <i class="bi bi-eye"></i> Ver Detalles
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach

                {{-- Pagination --}}
                <div class="d-flex justify-content-center">
                    {{ $orders->links() }}
                </div>
            @else
                {{-- Empty State --}}
                <div class="empty-message">
                    <i class="bi bi-inbox"></i>
                    <h3>No tienes pedidos</h3>
                    <p>Aún no has realizado ninguna compra.</p>
                    <a href="/" class="btn-shop">
                        <i class="bi bi-bag-check me-1"></i> Ir a la tienda
                    </a>
                </div>
            @endif
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
