# Referencia rápida - Sistema de Pagos

## 🚀 Inicio Rápido

### 1. Configurar Variables (`.env`)
```env
STRIPE_PUBLIC_KEY=pk_test_...
STRIPE_SECRET_KEY=sk_test_...
PAYPAL_CLIENT_ID=...
PAYPAL_CLIENT_SECRET=...
PAYPAL_MODE=sandbox
```

### 2. Ejecutar Migraciones
```bash
php artisan migrate
```

### 3. Iniciar Servidor
```bash
php artisan serve
```

### 4. Navegar a la tienda
```
http://localhost:8000
```

---

## 🛒 Flujo de Compra

1. Agregar productos → 🛒 Carrito → 💳 Proceder al Pago
2. Seleccionar método: **Stripe | PayPal | Banco**
3. Completar pago según método
4. Ver confirmación
5. Ver historial en "Mis Pedidos"

---

## 💳 Métodos de Pago

### Stripe
- ✅ Ingresa tarjeta
- ✅ Procesa automático
- ✅ Confirmación inmediata

### PayPal
- ✅ Login PayPal
- ✅ Autoriza pago
- ✅ Confirmación inmediata

### Banco
- ✅ Genera referencia
- ✅ Datos bancarios
- ✅ Pendiente confirmación

---

## 📁 Archivos Importantes

- `app/Models/Order.php` → Modelo
- `app/Models/OrderItem.php` → Items
- `app/Http/Controllers/PaymentController.php` → Lógica
- `resources/views/checkout/` → Vistas
- `routes/web.php` → Rutas
- `config/services.php` → Config

---

## 🧪 Testing

**Stripe:**
- Card: `4242 4242 4242 4242`
- Date: Cualquier futura (ej: 12/25)
- CVC: Cualquier 3 dígitos (ej: 123)

**PayPal:**
- Usa cuenta sandbox

**Banco:**
- Referencia es: `ORD + timestamp + random`

---

## 🔍 Ver Órdenes

### En BD (SQL)
```sql
SELECT * FROM orders;
SELECT * FROM order_items;
```

### En App
- Navegua a `/payment/my-orders`
- O en admin panel (futuro)

---

## ⚙️ Cambiar Configuración

### Moneda
En `PaymentController@createStripeIntent()`:
```php
'currency' => 'usd', // Cambia a tu moneda
```

### Datos Banco
En `checkout/bank.blade.php`:
```blade
'Banco Central Demo' → Tu banco
'1234567890' → Tu cuenta
'ES91...' → Tu IBAN
```

---

## 📊 Estadísticas

```bash
# Ver todas las órdenes
php artisan tinker
>>> Order::all();

# Por usuario
>>> auth()->user()->orders;

# Por estado
>>> Order::where('payment_status', 'completed')->count();
```

---

## 🐛 Errores Comunes

| Error | Solución |
|-------|----------|
| Ruta no encontrada | `php artisan route:cache --force` |
| Stripe key invalid | Verifica `.env` y `config:clear` |
| Tabla no existe | Ejecuta `php artisan migrate` |
| Carrito vacío | Agrega productos primero |

---

## 📞 Soporte Rápido

Dentro del proyecto:
- `PAYMENT_GUIDE.md` - Guía completa
- `PAYMENT_IMPLEMENTATION.md` - Implementación detallada
- `resources/views/checkout/` - Vistas HTML
- `app/Http/Controllers/PaymentController.php` - Código fuente

---

**¡Listo para procesar pagos! 💰**
