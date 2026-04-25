<!doctype html>
<html lang="es">
<head>
    <title>Transferencia Bancaria – Obet's Store</title>
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
            max-width: 700px;
        }

        .bank-details {
            background: #f8f9ff;
            border-left: 5px solid #27ae60;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .bank-details h4 {
            font-weight: 700;
            color: #2d2d2d;
            margin-bottom: 1rem;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid #e0e0e0;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-label {
            font-weight: 600;
            color: #666;
        }

        .detail-value {
            font-family: 'Courier New', monospace;
            font-weight: 700;
            color: #2d2d2d;
            font-size: 0.95rem;
        }

        .copy-btn {
            background: #27ae60;
            border: none;
            color: white;
            padding: 0.4rem 0.8rem;
            border-radius: 6px;
            font-size: 0.8rem;
            cursor: pointer;
            margin-left: 0.5rem;
            transition: all 0.2s;
        }

        .copy-btn:hover {
            background: #229954;
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
            color: #27ae60;
        }

        .reference-section {
            background: #fff3cd;
            border-left: 5px solid #ff9800;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .reference-section h5 {
            font-weight: 700;
            color: #856404;
            margin-bottom: 1rem;
        }

        .reference-code {
            background: white;
            border: 2px dashed #ff9800;
            border-radius: 10px;
            padding: 1rem;
            text-align: center;
            font-family: 'Courier New', monospace;
            font-weight: 700;
            font-size: 1.2rem;
            color: #2d2d2d;
            margin-bottom: 1rem;
            word-break: break-all;
        }

        .btn-confirm {
            background: linear-gradient(135deg, #27ae60 0%, #229954 100%);
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

        .btn-confirm:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(39, 174, 96, 0.45);
            color: white;
        }

        .instructions {
            background: #e7f3dd;
            border-radius: 12px;
            padding: 1.5rem;
            color: #2d5016;
        }

        .instructions h6 {
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .instructions ol {
            margin-bottom: 0;
        }

        .instructions li {
            margin-bottom: 0.5rem;
        }
    </style>
</head>
<body>
    <nav style="padding: 1rem 0; margin-bottom: 2rem;">
        <div class="container d-flex justify-content-between" style="max-width: 700px;">
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
                <h1><i class="bi bi-bank me-2"></i>Transferencia Bancaria</h1>
                <p>Realiza una transferencia a los datos que aparecen abajo</p>
            </div>

            <div class="payment-card">
                {{-- Amount --}}
                <div class="amount-display">
                    <div class="amount-label">Monto a transferir</div>
                    <div class="amount-value" id="display-amount">${{ number_format($total, 2) }}</div>
                </div>

                {{-- Bank Details --}}
                <div class="bank-details">
                    <h4><i class="bi bi-bank me-2"></i>Datos Bancarios</h4>
                    
                    <div class="detail-row">
                        <span class="detail-label">Banco:</span>
                        <span class="detail-value">
                            Banco Central Demo
                            <button class="copy-btn" onclick="copyToClipboard('Banco Central Demo')">
                                <i class="bi bi-clipboard"></i>
                            </button>
                        </span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Titular:</span>
                        <span class="detail-value">
                            Obet's Store S.A.
                            <button class="copy-btn" onclick="copyToClipboard('Obet\\'s Store S.A.')">
                                <i class="bi bi-clipboard"></i>
                            </button>
                        </span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Número de Cuenta:</span>
                        <span class="detail-value">
                            1234567890
                            <button class="copy-btn" onclick="copyToClipboard('1234567890')">
                                <i class="bi bi-clipboard"></i>
                            </button>
                        </span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">SWIFT/BIC:</span>
                        <span class="detail-value">
                            BCDMESXX
                            <button class="copy-btn" onclick="copyToClipboard('BCDMESXX')">
                                <i class="bi bi-clipboard"></i>
                            </button>
                        </span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">IBAN:</span>
                        <span class="detail-value">
                            ES9121001418450200051332
                            <button class="copy-btn" onclick="copyToClipboard('ES9121001418450200051332')">
                                <i class="bi bi-clipboard"></i>
                            </button>
                        </span>
                    </div>
                </div>

                {{-- Reference --}}
                <div class="reference-section">
                    <h5><i class="bi bi-info-circle me-2"></i>Referencia de Pago Importante</h5>
                    <div class="reference-code" id="bank-reference">{{ $bankReference }}</div>
                    <p class="mb-0 small">
                        <strong>IMPORTANTE:</strong> Usa esta referencia en el concepto/descripción de la transferencia para que tu pedido sea identificado correctamente.
                    </p>
                    <button class="copy-btn" onclick="copyToClipboard('{{ $bankReference }}') " style="margin-top: 1rem; width: 100%; padding: 0.6rem;">
                        <i class="bi bi-clipboard me-2"></i>Copiar Referencia
                    </button>
                </div>

                {{-- Instructions --}}
                <div class="instructions mb-3">
                    <h6><i class="bi bi-list-check me-2"></i>Pasos a Seguir</h6>
                    <ol>
                        <li>Copia los datos bancarios de arriba</li>
                        <li>Accede a tu aplicación de banca electrónica</li>
                        <li>Crea una nueva transferencia con los datos indicados</li>
                        <li>En el concepto, pega la referencia de pago</li>
                        <li>Revisa los datos y confirma la transferencia</li>
                        <li>Tu pedido será procesado cuando confirme la transferencia</li>
                    </ol>
                </div>

                <form id="bank-form">
                    <input type="hidden" id="bank-reference-input" value="{{ $bankReference }}">
                    <button type="submit" class="btn-confirm">
                        <i class="bi bi-check-circle me-2"></i>He realizado la transferencia
                    </button>
                </form>
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
                            <i class="bi bi-check-circle" style="font-size: 4rem; color: #ff9800; animation: bounceIn 0.8s ease;"></i>
                        </div>
                        <h3 style="font-weight: 800; color: #2d2d2d; margin-bottom: 0.5rem;">¡Orden Creada!</h3>
                        <p style="color: #666; margin-bottom: 1.5rem;">Tu transferencia bancaria está en espera de confirmación.</p>
                        
                        <div id="confDetails" style="background: #f8f9ff; border-radius: 10px; padding: 1.5rem; margin-bottom: 1.5rem; text-align: left;">
                            <div style="margin-bottom: 1rem;">
                                <strong style="color: #666; display: block; font-size: 0.9rem;">Número de Orden</strong>
                                <span id="orderId" style="font-size: 1.2rem; font-weight: 700; color: #ff9800;">-</span>
                            </div>
                            <div style="margin-bottom: 1rem;">
                                <strong style="color: #666; display: block; font-size: 0.9rem;">Monto a Transferir</strong>
                                <span id="amountPaid" style="font-size: 1.2rem; font-weight: 700; color: #27ae60;">-</span>
                            </div>
                            <div>
                                <strong style="color: #666; display: block; font-size: 0.9rem;">Estado</strong>
                                <span style="display: inline-block; background: #fff3cd; color: #856404; padding: 0.4rem 0.8rem; border-radius: 6px; font-weight: 600; font-size: 0.9rem;">Pendiente de Confirmación</span>
                            </div>
                        </div>

                        <p style="color: #999; font-size: 0.9rem; margin-bottom: 1.5rem;">Serás redirigido en <span id="countdown">5</span> segundos...</p>

                        <button id="goToConfirmation" type="button" class="btn btn-primary" style="background: #27ae60; border: none; border-radius: 8px; padding: 0.75rem 2rem; font-weight: 600;">
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

    <script>
        const CSRF = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const bankReference = '{{ $bankReference }}';
        const bankTotalAmount = {{ $total }};

        function showConfirmationModal(orderId) {
            const modal = document.getElementById('confirmationModal');
            document.getElementById('orderId').textContent = '#' + orderId;
            document.getElementById('amountPaid').textContent = '$' + bankTotalAmount.toFixed(2);
            
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

        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                alert('¡Copiado al portapapeles!');
            }).catch(err => {
                console.error('Error al copiar:', err);
            });
        }

        document.getElementById('bank-form').addEventListener('submit', async (e) => {
            e.preventDefault();

            const submitBtn = e.target.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Procesando...';

            try {
                const response = await fetch('{{ route("payment.process-bank") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': CSRF,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ bank_reference: bankReference })
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
            } catch (error) {
                alert('Error: ' + error.message);
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            }
        });
    </script>
</body>
</html>
