# Guía de Implementación del Sistema de Pagos

## Descripción General

El sistema de pagos de Obet's Store soporta tres métodos:

1. **Stripe** - Pagos con tarjeta de crédito/débito
2. **PayPal** - Pagos con cuenta PayPal
3. **Transferencia Bancaria** - Pagos mediante transferencia bancaria

## Instalación y Configuración

### 1. Paquetes Instalados

- **Stripe PHP SDK** - Para procesar pagos con tarjeta
- Versión: 19.4.0

### 2. Variables de Entorno

Actualiza tu archivo `.env` con las siguientes variables:

```env
# Stripe Configuration
STRIPE_PUBLIC_KEY=pk_test_your_publishable_key
STRIPE_SECRET_KEY=sk_test_your_secret_key

# PayPal Configuration
PAYPAL_CLIENT_ID=your_paypal_client_id
PAYPAL_CLIENT_SECRET=your_paypal_client_secret
PAYPAL_MODE=sandbox  # o 'live' para producción
```

### 3. Base de Datos

Se crearon dos tablas:

- **orders** - Almacena información de los pedidos
- **order_items** - Almacena los artículos de cada pedido

Las migraciones se ejecutan automáticamente con:
```bash
php artisan migrate
```

## Modelos

### Order
```php
- id: bigint
- user_id: foreignId (usuarios)
- total_amount: decimal(10,2)
- payment_method: enum('stripe', 'paypal', 'bank_transfer')
- payment_status: enum('pending', 'completed', 'failed', 'cancelled')
- transaction_id: string (único)
- order_status: enum('pending', 'processing', 'shipped', 'delivered', 'cancelled')
- bank_reference: string (para transferencias)
- notes: text
```

### OrderItem
```php
- id: bigint
- order_id: foreignId (órdenes)
- product_id: foreignId (productos)
- quantity: integer
- price: decimal(10,2)
- total: decimal(10,2)
```

## Controlador Principal

**PaymentController** (`app/Http/Controllers/PaymentController.php`)

### Métodos Principales

#### showCheckout()
Muestra la página de selección de método de pago con resumen del carrito.

#### createStripeIntent()
Crea una intención de pago en Stripe (POST).

#### processStripePayment()
Procesa el pago después de la confirmación de Stripe (POST).

#### showPayPalCheckout()
Muestra el formulario de pago de PayPal.

#### processPayPalPayment()
Procesa el pago de PayPal (POST).

#### showBankCheckout()
Muestra los datos bancarios y genera una referencia única.

#### processBankPayment()
Registra el pedido como pendiente de transferencia bancaria (POST).

#### confirmation()
Muestra la página de confirmación de pago.

#### myOrders()
Muestra el historial de pedidos del usuario.

## Rutas

### Rutas de Pago (prefijo: `/payment/`)

La mayoría requieren autenticación (`middleware: auth`).

- `GET /payment/checkout` → Página de selección de método
- `GET /payment/stripe` → Redirecciona a checkout
- `POST /payment/create-intent` → Crear intención Stripe
- `POST /payment/process-stripe` → Procesar pago Stripe
- `GET /payment/paypal` → Redirecciona a checkout
- `POST /payment/process-paypal` → Procesar pago PayPal
- `GET /payment/bank` → Página de transferencia bancaria
- `POST /payment/process-bank` → Procesar pago bancario
- `GET /payment/confirmation/{orderId}` → Confirmación de pago
- `GET /payment/my-orders` → Historial de pedidos

## Vistas

### checkout/index.blade.php
Página principal de selección de método de pago con:
- Resumen del pedido
- Grid de opciones de pago (Stripe, PayPal, Banco)
- Cálculo automático del total

### checkout/stripe.blade.php
Formulario de pago con Stripe:
- Integración con Stripe.js
- Validación en tiempo real
- Manejo de errores

### checkout/paypal.blade.php
Botón de pago de PayPal:
- Integración con SDK de PayPal
- Gestión de órdenes
- Procesamiento automático

### checkout/bank.blade.php
Información de transferencia bancaria:
- Datos bancarios completos (IBAN, SWIFT, etc.)
- Referencia única generada (ORD + timestamp + random)
- Instrucciones paso a paso
- Botones para copiar datos

### checkout/confirmation.blade.php
Confirmación de pago:
- Resumen del pedido
- Estado del pago
- Lista de artículos
- Número de pedido
- Enlaces a mis pedidos y tienda

### checkout/my-orders.blade.php
Historial de pedidos:
- Lista paginada de pedidos
- Estado de pago y envío
- Método de pago utilizado
- Monto total
- Enlaces a detalles

## Flujo de Pago

### Flujo Stripe

1. Usuario selecciona "Pagar con Tarjeta"
2. Sistema crea intención de pago en Stripe
3. Usuario ingresa datos de tarjeta
4. Stripe valida y procesa el pago
5. Sistema registra orden como completada
6. Usuario ve confirmación
7. Carrito se vacía

### Flujo PayPal

1. Usuario selecciona "Pagar con PayPal"
2. Botón de PayPal redirige a login
3. Usuario autoriza pago
4. PayPal retorna a la aplicación
5. Sistema registra orden como completada
6. Usuario ve confirmación
7. Carrito se vacía

### Flujo Banco

1. Usuario selecciona "Transferencia Bancaria"
2. Sistema genera referencia única (ORD + datos)
3. Usuario ve datos bancarios e instrucciones
4. Usuario puede copiar datos con un clic
5. Sistema registra orden como pendiente
6. Usuario realiza transferencia con referencia
7. Admin verifica y confirma
8. Usuario ve confirmación

## Características de Seguridad

- ✓ Middleware de autenticación en todas las rutas
- ✓ Tokens CSRF en formularios
- ✓ Validación de carrito antes de procesar
- ✓ Verificación de propiedad de pedido
- ✓ Números de transacción únicos
- ✓ Encriptación de datos sensibles (con Stripe)
- ✓ Manejo de errores y excepciones

## Personalización

### Datos Bancarios (checkout/bank.blade.php)

Actualiza los siguientes datos según tu banco:
```javascript
'Banco Central Demo' // Nombre del banco
'Obet\'s Store S.A.' // Titular
'1234567890'        // Número de cuenta
'BCDMESXX'          // SWIFT/BIC
'ES9121001418450200051332' // IBAN
```

### Moneda

Por defecto está configurada en USD. Para cambiar a otra moneda:
1. Modificar en `PaymentController` → `createStripeIntent()`
2. Actualizar la moneda 'usd' a la deseada
3. Ajustar formato de visualización en las vistas

## Testing

### Datos de Prueba Stripe

Tarjeta válida: `4242 4242 4242 4242`
- Fecha: Cualquier fecha futura (ej: 12/25)
- CVC: Cualquier 3 dígitos (ej: 123)

### Datos de Prueba PayPal (Sandbox)

Usa la cuenta sandbox configurada en PayPal Developer Center.

## Documentación Adicional

- [Documentación Stripe](https://stripe.com/docs)
- [Documentación PayPal](https://developer.paypal.com/)
- [API Referencias Stripe](https://stripe.com/docs/api)

## Soporte

Para soporte técnico, contacta al equipo de desarrollo.
