<!doctype html>
<html lang="es">
<head>
    <title>Pago con Stripe – Obet's Store</title>
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

        .form-label {
            font-weight: 600;
            color: #2d2d2d;
            margin-bottom: 0.5rem;
        }

        .form-control, .StripeElement {
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            padding: 0.75rem;
            font-size: 0.95rem;
            transition: border-color 0.2s;
        }

        .form-control:focus, .StripeElement {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .btn-pay {
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
            margin-top: 1.5rem;
        }

        .btn-pay:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102,126,234,0.45);
            color: white;
        }

        .btn-pay:disabled {
            opacity: 0.6;
            cursor: not-allowed;
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
            color: #667eea;
        }

        .stripe-logo {
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
                <h1><i class="bi bi-credit-card me-2"></i>Pago con Tarjeta</h1>
                <p>Completa tu información de pago de forma segura</p>
            </div>

            {{-- Error alert --}}
            <div id="error-alert" class="alert alert-danger d-none" role="alert"></div>

            <div class="payment-card">
                <div class="amount-display">
                    <div class="amount-label">Monto a pagar</div>
                    <div class="amount-value" id="display-amount">${{ number_format($total, 2) }}</div>
                </div>

                <form id="payment-form">
                    <div class="mb-3">
                        <label class="form-label" for="cardholder-name">Nombre del Titular</label>
                        <input class="form-control" id="cardholder-name" type="text" placeholder="Juan Pérez" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Información de la Tarjeta</label>
                        <div id="card-element" style="border: 2px solid #e0e0e0; border-radius: 10px; padding: 0.75rem;"></div>
                    </div>

                    <button class="btn-pay" id="submit-btn" type="submit" disabled>
                        <i class="bi bi-shield-lock me-2"></i> Pagar ${{ number_format($total, 2) }}
                    </button>
                </form>

                <div class="stripe-logo">
                    <i class="bi bi-shield-check me-1"></i> Pagos seguros con Stripe
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
                                <span id="orderId" style="font-size: 1.2rem; font-weight: 700; color: #667eea;">-</span>
                            </div>
                            <div>
                                <strong style="color: #666; display: block; font-size: 0.9rem;">Monto Pagado</strong>
                                <span id="amountPaid" style="font-size: 1.2rem; font-weight: 700; color: #27ae60;">-</span>
                            </div>
                        </div>

                        <p style="color: #999; font-size: 0.9rem; margin-bottom: 1.5rem;">Serás redirigido en <span id="countdown">5</span> segundos...</p>

                        <button id="goToConfirmation" type="button" class="btn btn-primary" style="background: #667eea; border: none; border-radius: 8px; padding: 0.75rem 2rem; font-weight: 600;">
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

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const STRIPE_KEY = '{{ config("services.stripe.public") }}';
        const CSRF = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const stripeTotalAmount = {{ $total }};

        function showConfirmationModal(orderId) {
            const modal = document.getElementById('confirmationModal');
            document.getElementById('orderId').textContent = '#' + orderId;
            document.getElementById('amountPaid').textContent = '$' + stripeTotalAmount.toFixed(2);
            
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
        
        if (!STRIPE_KEY) {
            document.getElementById('error-alert').innerHTML = '<strong>Error:</strong> Stripe no está configurado correctamente.';
            document.getElementById('error-alert').classList.remove('d-none');
        }

        const stripe = Stripe(STRIPE_KEY);
        const elements = stripe.elements();
        const cardElement = elements.create('card');

        cardElement.mount('#card-element');
        document.getElementById('submit-btn').disabled = false;

        // Handle real-time validation errors from the card Element
        cardElement.on('change', function(event) {
            const displayError = document.getElementById('error-alert');
            if (event.error) {
                displayError.textContent = event.error.message;
                displayError.classList.remove('d-none');
                document.getElementById('submit-btn').disabled = true;
            } else {
                displayError.textContent = '';
                displayError.classList.add('d-none');
                document.getElementById('submit-btn').disabled = false;
            }
        });

        // Handle form submission
        document.getElementById('payment-form').addEventListener('submit', async (e) => {
            e.preventDefault();

            const submittingBtn = document.getElementById('submit-btn');
            submittingBtn.disabled = true;
            const originalText = submittingBtn.innerHTML;
            submittingBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Procesando...';

            const cardholderName = document.getElementById('cardholder-name').value;

            try {
                // Create payment method
                const { paymentMethod, error } = await stripe.createPaymentMethod({
                    type: 'card',
                    card: cardElement,
                    billing_details: { name: cardholderName }
                });

                if (error) {
                    throw new Error(error.message);
                }

                // Create payment intent
                const intentResponse = await fetch('{{ route("payment.create-intent") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': CSRF,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ payment_method_id: paymentMethod.id })
                });

                if (!intentResponse.ok) {
                    throw new Error('Error al crear la intención de pago');
                }

                const intentData = await intentResponse.json();

                // Confirm payment
                const { paymentIntent, error: confirmError } = await stripe.confirmCardPayment(
                    intentData.clientSecret,
                    { payment_method: paymentMethod.id }
                );

                if (confirmError) {
                    throw new Error(confirmError.message);
                }

                if (paymentIntent.status === 'succeeded') {
                    // Process payment on server
                    const response = await fetch('{{ route("payment.process-stripe") }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': CSRF,
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ payment_intent_id: paymentIntent.id })
                    });

                    if (!response.ok) {
                        throw new Error('Error al procesar el pago');
                    }

                    const data = await response.json();

                    if (data.success) {
                        showConfirmationModal(data.order_id);
                    } else {
                        throw new Error(data.error);
                    }
                } else {
                    throw new Error('El pago no fue completado');
                }
            } catch (error) {
                const displayError = document.getElementById('error-alert');
                displayError.textContent = error.message;
                displayError.classList.remove('d-none');

                submittingBtn.disabled = false;
                submittingBtn.innerHTML = originalText;
            }
        });
    </script>
</body>
</html>
