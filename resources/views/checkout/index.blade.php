<!doctype html>
<html lang="es">
<head>
    <title>Checkout – Obet's Store</title>
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

        .checkout-card {
            background: white;
            border-radius: 18px;
            box-shadow: 0 15px 45px rgba(0,0,0,0.2);
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .payment-methods {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .payment-option {
            border: 3px solid #e0e0e0;
            border-radius: 15px;
            padding: 1.5rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: white;
        }

        .payment-option:hover {
            border-color: #667eea;
            box-shadow: 0 8px 20px rgba(102,126,234,0.2);
            transform: translateY(-4px);
        }

        .payment-option.active {
            border-color: #667eea;
            background: linear-gradient(135deg, #667eea15, #764ba215);
        }

        .payment-option i {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .payment-option.stripe i { color: #667eea; }
        .payment-option.paypal i { color: #003087; }
        .payment-option.bank i { color: #27ae60; }

        .payment-option h3 {
            font-weight: 700;
            font-size: 1.1rem;
            color: #2d2d2d;
            margin-bottom: 0.5rem;
        }

        .payment-option p {
            font-size: 0.85rem;
            color: #666;
        }

        .order-summary {
            background: #f8f9ff;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .order-summary h4 {
            font-weight: 700;
            margin-bottom: 1rem;
            color: #2d2d2d;
        }

        .order-item {
            display: flex;
            justify-content: space-between;
            padding: 0.75rem 0;
            border-bottom: 1px solid #e0e0e0;
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .order-total {
            display: flex;
            justify-content: space-between;
            padding: 1rem 0;
            border-top: 2px solid #667eea;
            font-weight: 700;
            font-size: 1.2rem;
            color: #2d2d2d;
            margin-top: 1rem;
        }

        .btn-proceed {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            padding: 0.85rem 2rem;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.2s;
            width: 100%;
        }

        .btn-proceed:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102,126,234,0.45);
            color: white;
        }

        .btn-proceed:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .back-link {
            color: white;
            text-decoration: none;
            font-weight: 600;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <nav style="padding: 1rem 0; margin-bottom: 2rem;">
        <div class="container d-flex align-items-center justify-content-between">
            <a class="navbar-brand-custom" href="/">
                <i class="bi bi-shop me-1"></i> Obet's Store
            </a>
            <a href="{{ route('cart.index') }}" class="back-link">
                <i class="bi bi-arrow-left me-1"></i> Volver al carrito
            </a>
        </div>
    </nav>

    <main>
        <div class="container" style="max-width:900px;">
            <div class="page-header">
                <h1><i class="bi bi-credit-card me-2"></i>Proceder al Pago</h1>
                <p>Selecciona tu método de pago preferido</p>
            </div>

            {{-- Order Summary --}}
            <div class="checkout-card">
                <div class="order-summary">
                    <h4><i class="bi bi-bag-check me-2"></i>Resumen del Pedido</h4>
                    @foreach($cart as $id => $item)
                        <div class="order-item">
                            <span>{{ $item['name'] }} (x{{ $item['quantity'] }})</span>
                            <span>${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                        </div>
                    @endforeach
                    <div class="order-total">
                        <span>Total:</span>
                        <span id="total-amount">${{ number_format($total, 2) }}</span>
                    </div>
                </div>
            </div>

            {{-- Payment Methods --}}
            <div class="checkout-card">
                <h3 class="mb-3">Métodos de Pago Disponibles</h3>
                
                <div class="payment-methods">
                    {{-- Stripe --}}
                    <div class="payment-option stripe" onclick="selectPayment('stripe')">
                        <i class="bi bi-credit-card-2-front"></i>
                        <h3>Tarjeta de Crédito</h3>
                        <p>Stripe</p>
                    </div>

                    {{-- PayPal --}}
                    <div class="payment-option paypal" onclick="selectPayment('paypal')">
                        <i class="bi bi-paypal"></i>
                        <h3>PayPal</h3>
                        <p>Pago seguro</p>
                    </div>

                    {{-- Bank Transfer --}}
                    <div class="payment-option bank" onclick="selectPayment('bank')">
                        <i class="bi bi-bank"></i>
                        <h3>Transferencia Bancaria</h3>
                        <p>Referencia bancaria</p>
                    </div>
                </div>

                <div id="payment-form" style="margin-top: 2rem; display: none;">
                    <button class="btn-proceed" id="proceed-btn" onclick="proceedPayment()">
                        Proceder al Pago
                    </button>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let selectedMethod = null;

        function selectPayment(method) {
            selectedMethod = method;
            
            // Update UI
            document.querySelectorAll('.payment-option').forEach(opt => {
                opt.classList.remove('active');
            });
            event.target.closest('.payment-option').classList.add('active');
            
            document.getElementById('payment-form').style.display = 'block';
            document.getElementById('proceed-btn').textContent = getButtonText(method);
        }

        function getButtonText(method) {
            const texts = {
                'stripe': 'Pagar con Tarjeta',
                'paypal': 'Pagar con PayPal',
                'bank': 'Proceder con Transferencia'
            };
            return texts[method] || 'Proceder al Pago';
        }

        function proceedPayment() {
            if (!selectedMethod) {
                alert('Por favor selecciona un método de pago');
                return;
            }

            const routes = {
                'stripe': '{{ route("payment.stripe") }}',
                'paypal': '{{ route("payment.paypal") }}',
                'bank': '{{ route("payment.bank") }}'
            };

            window.location.href = routes[selectedMethod];
        }
    </script>
</body>
</html>
