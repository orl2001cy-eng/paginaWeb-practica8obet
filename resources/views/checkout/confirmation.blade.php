<!doctype html>
<html lang="es">
<head>
    <title>Confirmación de Pago – Obet's Store</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

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

        .success-card {
            background: white;
            border-radius: 18px;
            box-shadow: 0 15px 45px rgba(0,0,0,0.2);
            padding: 2rem;
            max-width: 650px;
            text-align: center;
        }

        .success-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #27ae60, #229954);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            animation: scaleIn 0.5s ease;
        }

        @keyframes scaleIn {
            from { transform: scale(0); }
            to { transform: scale(1); }
        }

        .success-icon i {
            font-size: 2.5rem;
            color: white;
        }

        .success-title {
            font-size: 1.8rem;
            font-weight: 800;
            color: #2d2d2d;
            margin-bottom: 0.5rem;
        }

        .success-subtitle {
            color: #666;
            margin-bottom: 2rem;
        }

        .order-info {
            background: #f8f9ff;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            text-align: left;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 0.75rem 0;
            border-bottom: 1px solid #e0e0e0;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            font-weight: 600;
            color: #666;
        }

        .info-value {
            font-weight: 700;
            color: #2d2d2d;
            text-align: right;
        }

        .order-items {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            text-align: left;
        }

        .items-title {
            font-weight: 700;
            margin-bottom: 1rem;
            color: #2d2d2d;
        }

        .item-row {
            display: flex;
            justify-content: space-between;
            padding: 0.75rem 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .item-row:last-child {
            border-bottom: none;
        }

        .item-name {
            flex: 1;
            color: #2d2d2d;
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

        .total-row {
            border-top: 2px solid #667eea;
            padding-top: 1rem;
            margin-top: 1rem;
            display: flex;
            justify-content: space-between;
            font-weight: 700;
            font-size: 1.1rem;
            color: #2d2d2d;
        }

        .status-badge {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.85rem;
            margin-bottom: 1rem;
        }

        .status-completed {
            background: #d4edda;
            color: #155724;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .actions {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            margin-top: 2rem;
        }

        .btn-primary-action {
            flex: 1;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            padding: 0.85rem 1.5rem;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.95rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.2s;
            min-width: 150px;
        }

        .btn-primary-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102,126,234,0.45);
            color: white;
        }

        .btn-secondary-action {
            flex: 1;
            background: white;
            border: 2px solid #667eea;
            color: #667eea;
            padding: 0.85rem 1.5rem;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.95rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.2s;
            min-width: 150px;
        }

        .btn-secondary-action:hover {
            background: #667eea;
            color: white;
        }

        .bank-pending-alert {
            background: #fff3cd;
            border-left: 5px solid #ff9800;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .bank-pending-alert h6 {
            font-weight: 700;
            color: #856404;
            margin-bottom: 0.5rem;
        }

        .bank-pending-alert p {
            color: #856404;
            margin-bottom: 0;
            font-size: 0.95rem;
        }

        /* ── Print button ── */
        .btn-print-action {
            flex: 1;
            background: white;
            border: 2px solid #27ae60;
            color: #27ae60;
            padding: 0.85rem 1.5rem;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.95rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.2s;
            min-width: 150px;
            cursor: pointer;
        }
        .btn-print-action:hover {
            background: #27ae60;
            color: white;
        }
        .btn-print-action:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        /* ── Print toast ── */
        .print-toast {
            position: fixed;
            bottom: 1.5rem;
            right: 1.5rem;
            z-index: 1100;
            min-width: 260px;
            border-radius: 14px;
            padding: 1rem 1.4rem;
            font-weight: 600;
            font-size: 0.9rem;
            box-shadow: 0 8px 24px rgba(0,0,0,0.18);
            animation: slideUp 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }
        .print-toast.success { background: #d4edda; color: #155724; border: 1.5px solid #c3e6cb; }
        .print-toast.error   { background: #f8d7da; color: #721c24; border: 1.5px solid #f5c6cb; }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <main class="d-flex align-items-center justify-content-center" style="min-height: 100vh; padding: 2rem;">
        <div style="max-width: 650px; width: 100%;">
            <div class="success-card">
                <div class="success-icon">
                    <i class="bi bi-check-lg"></i>
                </div>

                <h1 class="success-title">¡Pedido Confirmado!</h1>
                <p class="success-subtitle">Tu pago ha sido procesado correctamente</p>

                <div class="status-badge status-{{ $order->payment_status }}">
                    @if($order->payment_status === 'completed')
                        <i class="bi bi-check-circle me-1"></i>Pago Completado
                    @elseif($order->payment_status === 'pending')
                        <i class="bi bi-clock-history me-1"></i>Pago Pendiente
                    @endif
                </div>

                {{-- Bank Transfer Pending Alert --}}
                @if($order->payment_method === 'bank_transfer' && $order->payment_status === 'pending')
                    <div class="bank-pending-alert">
                        <h6><i class="bi bi-info-circle me-2"></i>Transferencia Pendiente</h6>
                        <p>
                            Tu pedido ha sido creado. Por favor, realiza la transferencia bancaria con la referencia <strong>{{ $order->bank_reference }}</strong> para completar tu compra.
                        </p>
                    </div>
                @endif

                {{-- Order Information --}}
                <div class="order-info">
                    <div class="info-row">
                        <span class="info-label">Número de Pedido</span>
                        <span class="info-value">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Método de Pago</span>
                        <span class="info-value">
                            @if($order->payment_method === 'stripe')
                                <i class="bi bi-credit-card me-1"></i>Tarjeta
                            @elseif($order->payment_method === 'paypal')
                                <i class="bi bi-paypal me-1"></i>PayPal
                            @else
                                <i class="bi bi-bank me-1"></i>Transferencia
                            @endif
                        </span>
                    </div>
                    @if($order->transaction_id)
                        <div class="info-row">
                            <span class="info-label">ID Transacción</span>
                            <span class="info-value" style="font-size: 0.85rem; word-break: break-all;">{{ substr($order->transaction_id, 0, 20) }}...</span>
                        </div>
                    @endif
                    <div class="info-row">
                        <span class="info-label">Fecha</span>
                        <span class="info-value">{{ $order->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                </div>

                {{-- Order Items --}}
                <div class="order-items">
                    <div class="items-title"><i class="bi bi-bag-check me-2"></i>Artículos del Pedido</div>
                    @foreach($order->items as $item)
                        <div class="item-row">
                            <span class="item-name">{{ $item->product->name }}</span>
                            <span class="item-qty">x{{ $item->quantity }}</span>
                            <span class="item-price">${{ number_format($item->total, 2) }}</span>
                        </div>
                    @endforeach
                    <div class="total-row">
                        <span>Total:</span>
                        <span>${{ number_format($order->total_amount, 2) }}</span>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="actions">
                    <a href="{{ route('payment.my-orders') }}" class="btn-primary-action">
                        <i class="bi bi-list-check me-1"></i>Ver Mis Pedidos
                    </a>
                    <a href="{{ route('payment.print-receipt', $order->id) }}"
                       target="_blank"
                       rel="noopener"
                       class="btn-print-action">
                        <i class="bi bi-printer me-1"></i>Imprimir Comprobante
                    </a>
                    <a href="/" class="btn-secondary-action">
                        <i class="bi bi-shop me-1"></i>Seguir Comprando
                    </a>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const CSRF = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
            ?? document.cookie.match(/XSRF-TOKEN=([^;]+)/)?.[1];

        function showPrintToast(message, type) {
            document.querySelectorAll('.print-toast').forEach(t => t.remove());
            const icon = type === 'success' ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill';
            const toast = document.createElement('div');
            toast.className = `print-toast ${type}`;
            toast.innerHTML = `<i class="bi ${icon}"></i>${message}`;
            document.body.appendChild(toast);
            setTimeout(() => {
                toast.style.transition = 'opacity 0.4s';
                toast.style.opacity = '0';
                setTimeout(() => toast.remove(), 400);
            }, 4000);
        }

        async function printReceipt(orderId) {
            const btn = document.getElementById('btn-print');
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status"></span> Imprimiendo...';

            try {
                const response = await fetch(`/payment/print-receipt/${orderId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': CSRF,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    showPrintToast('✅ ' + data.message, 'success');
                } else {
                    showPrintToast('❌ ' + (data.error ?? 'Error al imprimir'), 'error');
                }
            } catch (e) {
                showPrintToast('❌ No se pudo conectar con la impresora', 'error');
            } finally {
                btn.disabled = false;
                btn.innerHTML = '<i class="bi bi-printer me-1"></i>Imprimir Comprobante';
            }
        }
    </script>
</body>
</html>
