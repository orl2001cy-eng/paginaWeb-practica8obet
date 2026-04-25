<!doctype html>
<html lang="es">
<head>
    <title>Pago con PayPal – Obet's Store</title>
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

        .page-header {
            text-align: center;
            color: white;
            margin-bottom: 2rem;
        }

        .payment-card {
            background: white;
            border-radius: 18px;
            box-shadow: 0 15px 45px rgba(0,0,0,0.2);
            padding: 2rem;
            max-width: 600px;
        }

        .amount-display {
            background: #f8f9ff;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            text-align: center;
        }

        .amount-label {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .amount-value {
            font-size: 2rem;
            font-weight: 800;
            color: #003087;
        }

        #paypal-button-container {
            margin: 2rem 0;
        }

        .paypal-logo {
            text-align: center;
            margin-top: 1.5rem;
            color: #999;
            font-size: 0.85rem;
        }

        .alert {
            border-radius: 12px;
            border: 2px solid;
        }
    </style>
</head>
<body>
    <nav style="padding: 1rem 0; margin-bottom: 2rem;">
        <div class="container d-flex justify-content-between" style="max-width: 600px;">
            <a href="/" style="color: white; font-weight: 800; font-size: 1.2rem; text-decoration: none;">
                <i class="bi bi-shop me-1"></i> Obet's Store
            </a>
            <a href="{{ route('payment.checkout') }}" style="color: white; text-decoration: none; font-weight: 600;">
                <i class="bi bi-arrow-left me-1"></i> Atrás
            </a>
        </div>
    </nav>

    <main class="d-flex justify-content-center">
        <div style="max-width:900px; width:100%; margin:0 2rem;">
            <div class="page-header">
                <h1><i class="bi bi-paypal me-2"></i>Pago con PayPal</h1>
                <p>Paga de forma segura con tu cuenta de PayPal</p>
            </div>

            {{-- Error alert --}}
            <div id="error-alert" class="alert alert-danger d-none" role="alert"></div>

            <div class="payment-card">
                <div class="amount-display">
                    <div class="amount-label">Monto a pagar</div>
                    <div class="amount-value" id="display-amount">${{ number_format($total, 2) }}</div>
                </div>

                <div id="paypal-button-container"></div>

                <div class="paypal-logo">
                    <i class="bi bi-shield-check me-1"></i> Pagos seguros con PayPal
                </div>
            </div>
        </div>
    </main>

    <!-- Confirmation Modal -->
    <div id="confirmationModal" class="modal fade" tabindex="-1" role="dialog" style="display: none; background: rgba(0,0,0,0.8);">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="border-radius: 15px; border: none;">
                <div class="modal-body p-5">
                    <div style="text-align: center;">
                        <div style="margin-bottom: 1rem;">
                            <i class="bi bi-check2-circle" style="font-size: 4rem; color: #27ae60; animation: bounceIn 0.8s ease;"></i>
                        </div>
                        <h3 style="font-weight: 800; color: #2d2d2d; margin-bottom: 0.5rem;">¡Compra Exitosa!</h3>
                        <p style="color: #666; margin-bottom: 1.5rem;">Tu pago ha sido procesado correctamente.</p>
                        
                        <div id="confDetails" style="background: #f8f9ff; border-radius: 10px; padding: 1.5rem; margin-bottom: 1.5rem; text-align: left;">
                            <div style="margin-bottom: 1rem;">
                                <strong style="color: #666; display: block; font-size: 0.9rem;">Número de Orden</strong>
                                <span id="orderId" style="font-size: 1.2rem; font-weight: 700; color: #003087;">-</span>
                            </div>
                            <div>
                                <strong style="color: #666; display: block; font-size: 0.9rem;">Monto Pagado</strong>
                                <span id="amountPaid" style="font-size: 1.2rem; font-weight: 700; color: #27ae60;">-</span>
                            </div>
                        </div>

                        <p style="color: #999; font-size: 0.9rem; margin-bottom: 1.5rem;">Serás redirigido en <span id="countdown">5</span> segundos...</p>

                        <button id="goToConfirmation" type="button" class="btn btn-primary" style="background: #003087; border: none; border-radius: 8px; padding: 0.75rem 2rem; font-weight: 600;">
                            Ver Detalles de Compra <i class="bi bi-arrow-right ms-2"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes bounceIn {
            0% { transform: scale(0); opacity: 0; }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); opacity: 1; }
        }
        
        @keyframes fadeInUp {
            from { 
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .confirmation-shown { animation: fadeInUp 0.5s ease; }
    </style>

    <script src="https://www.paypal.com/sdk/js?client-id={{ config('services.paypal.client_id') }}"></script>
    <script>
        const CSRF = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const amount = {{ $total }};

        function showConfirmationModal(orderId) {
            const modal = document.getElementById('confirmationModal');
            document.getElementById('orderId').textContent = '#' + orderId;
            document.getElementById('amountPaid').textContent = '$' + amount.toFixed(2);
            
            modal.style.display = 'flex';
            modal.style.alignItems = 'center';
            modal.style.justifyContent = 'center';
            modal.classList.add('confirmation-shown');

            // Countdown and redirect
            let countdown = 5;
            const countdownElement = document.getElementById('countdown');
            const interval = setInterval(() => {
                countdown--;
                countdownElement.textContent = countdown;
                if (countdown === 0) {
                    clearInterval(interval);
                    redirectToConfirmation(orderId);
                }
            }, 1000);

            document.getElementById('goToConfirmation').addEventListener('click', function() {
                clearInterval(interval);
                redirectToConfirmation(orderId);
            });
        }

        function redirectToConfirmation(orderId) {
            window.location.href = '/payment/confirmation/' + orderId;
        }

        paypal.Buttons({
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: amount.toFixed(2)
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(orderData) {
                    // Process order on server
                    return fetch('{{ route("payment.process-paypal") }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': CSRF,
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            transaction_id: orderData.id,
                            payer_email: orderData.payer.email_address
                        })
                    })
                    .then(response => response.json())
                    .then(responseData => {
                        if (responseData.success) {
                            showConfirmationModal(responseData.order_id);
                        } else {
                            throw new Error(responseData.error || 'Error al procesar el pago');
                        }
                    })
                    .catch(error => {
                        const displayError = document.getElementById('error-alert');
                        displayError.textContent = 'Error: ' + error.message;
                        displayError.classList.remove('d-none');
                        console.error('Payment error:', error);
                    });
                });
            },
            onError: function(err) {
                const displayError = document.getElementById('error-alert');
                displayError.textContent = 'Error en PayPal: ' + (err.message || 'Intenta nuevamente');
                displayError.classList.remove('d-none');
                console.error('PayPal error:', err);
            }
        }).render('#paypal-button-container');
    </script>
</body>
</html>
