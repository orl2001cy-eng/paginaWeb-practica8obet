<!doctype html>
<html lang="es">
<head>
    <title>Comprobante #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</title>
    <meta charset="utf-8" />
    <style>
        /* ── Thermal 58mm paper layout ── */
        @page {
            size: 58mm auto;
            margin: 2mm 2mm 4mm 2mm;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 11px;
            color: #000;
            width: 54mm;
            background: #fff;
        }

        .center  { text-align: center; }
        .right   { text-align: right; }
        .bold    { font-weight: bold; }
        .big     { font-size: 14px; font-weight: bold; }
        .divider { border-top: 1px dashed #000; margin: 3px 0; }
        .divider-solid { border-top: 1px solid #000; margin: 3px 0; }

        /* Header */
        .store-name {
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            letter-spacing: 1px;
            margin-bottom: 2px;
        }
        .store-sub {
            font-size: 9px;
            text-align: center;
            margin-bottom: 4px;
        }

        /* Info rows */
        .info-row {
            display: flex;
            justify-content: space-between;
            margin: 1px 0;
            font-size: 10px;
        }
        .info-label { color: #333; }

        /* Items table */
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
            margin: 3px 0;
        }
        th {
            font-weight: bold;
            border-bottom: 1px solid #000;
            padding: 1px 0;
        }
        td { padding: 2px 0; }
        .col-name  { width: 60%; }
        .col-qty   { width: 10%; text-align: center; }
        .col-price { width: 30%; text-align: right; }

        /* Total */
        .total-row {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            font-weight: bold;
            margin-top: 3px;
            padding-top: 3px;
            border-top: 1px solid #000;
        }

        /* Footer */
        .footer {
            text-align: center;
            font-size: 9px;
            margin-top: 5px;
        }

        /* Hide print button when printing */
        @media print {
            .no-print { display: none !important; }
            body { width: 54mm; }
        }

        /* Screen-only preview styles */
        @media screen {
            body {
                margin: 20px auto;
                border: 1px dashed #ccc;
                padding: 6px;
                box-shadow: 2px 2px 8px rgba(0,0,0,0.1);
            }
            .no-print {
                display: block;
                margin: 12px auto;
                text-align: center;
            }
            .no-print button {
                background: #667eea;
                color: white;
                border: none;
                padding: 8px 20px;
                border-radius: 20px;
                font-size: 13px;
                font-weight: bold;
                cursor: pointer;
                margin: 0 4px;
            }
            .no-print button.close-btn {
                background: #ccc;
                color: #333;
            }
            .printer-banner {
                display: none;
                background: #fffbe6;
                border: 1px solid #f0a500;
                border-radius: 6px;
                padding: 7px 10px;
                font-size: 11px;
                color: #7a4f00;
                margin: 8px auto 4px auto;
                text-align: center;
            }
        }
    </style>
</head>
<body>

    {{-- ── Header ── --}}
    <div class="store-name">Obet's Store</div>
    <div class="store-sub">Comprobante de Compra</div>
    <div class="divider-solid"></div>

    {{-- ── Order info ── --}}
    <div class="info-row">
        <span class="info-label">Orden</span>
        <span class="bold">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</span>
    </div>
    <div class="info-row">
        <span class="info-label">Fecha</span>
        <span>{{ $order->created_at->format('d/m/Y H:i') }}</span>
    </div>
    <div class="info-row">
        <span class="info-label">Metodo</span>
        <span>
            @if($order->payment_method === 'stripe')    Tarjeta
            @elseif($order->payment_method === 'paypal') PayPal
            @else                                         Transferencia
            @endif
        </span>
    </div>
    <div class="info-row">
        <span class="info-label">Estado</span>
        <span class="bold">
            {{ $order->payment_status === 'completed' ? 'PAGADO' : 'PENDIENTE' }}
        </span>
    </div>
    @if($order->transaction_id)
    <div class="info-row">
        <span class="info-label">Tx ID</span>
        <span style="font-size:8px;">{{ substr($order->transaction_id, 0, 18) }}...</span>
    </div>
    @endif

    <div class="divider"></div>

    {{-- ── Items ── --}}
    <table>
        <thead>
            <tr>
                <th class="col-name">Producto</th>
                <th class="col-qty">Cant</th>
                <th class="col-price">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td class="col-name">{{ mb_substr($item->product->name, 0, 20) }}</td>
                <td class="col-qty">{{ $item->quantity }}</td>
                <td class="col-price">${{ number_format($item->total, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- ── Total ── --}}
    <div class="total-row">
        <span>TOTAL:</span>
        <span>${{ number_format($order->total_amount, 2) }}</span>
    </div>

    <div class="divider-solid"></div>

    {{-- ── Footer ── --}}
    <div class="footer">
        <div>Gracias por tu compra!</div>
        <div>Conserva este comprobante</div>
    </div>

    {{-- ── Printer reminder (hidden when printing) ── --}}
    <div class="no-print printer-banner" id="printerBanner">
        🖨️ <strong>Impresora requerida:</strong> selecciona <em>EC PM 80330</em> en el diálogo de impresión.
    </div>

    {{-- ── Print / Close buttons (hidden when printing) ── --}}
    <div class="no-print">
        <button onclick="doPrint()">🖨️ Imprimir</button>
        <button class="close-btn" onclick="window.close()">✕ Cerrar</button>
    </div>

    <script>
        function doPrint() {
            // Show reminder then open print dialog
            var banner = document.getElementById('printerBanner');
            banner.style.display = 'block';
            setTimeout(function () {
                window.print();
            }, 300);
        }

        // Auto-print when opened from the confirmation page
        if (window.opener) {
            window.onload = function () { doPrint(); };
        }
    </script>
</body>
</html>
