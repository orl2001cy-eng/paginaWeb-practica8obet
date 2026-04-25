<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReceiptController;

use App\Http\Controllers\UserController;

Route::get("/", [ProductController::class, "home"])->name("welcome");

Route::get("/welcome-simple", [ProductController::class, "publicIndex"])->name("welcome.simple");

// Carrito — ruta pública: devuelve 401 JSON si no está autenticado
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/{productId}/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count');


// Custom auth routes with better control
Route::get("login", [LoginController::class, "showLoginForm"])->name("login");
Route::post("login", [LoginController::class, "login"]);
Route::match(["get", "post"], "logout", [LoginController::class, "logout"])
    ->name("logout")
    ->middleware(["auth", "security:logout"]);

Route::get("register", [
    RegisterController::class,
    "showRegistrationForm",
])->name("register");
Route::post("register", [RegisterController::class, "register"]);

Route::get("password/reset", [
    ForgotPasswordController::class,
    "showLinkRequestForm",
])->name("password.request");
Route::post("password/email", [
    ForgotPasswordController::class,
    "sendResetLinkEmail",
])->name("password.email");
Route::get("password/reset/{token}", [
    ResetPasswordController::class,
    "showResetForm",
])->name("password.reset");
Route::post("password/reset", [ResetPasswordController::class, "reset"])->name(
    "password.update",
);
Route::get("password/confirm", [
    ConfirmPasswordController::class,
    "showConfirmForm",
])->name("password.confirm");
Route::post("password/confirm", [ConfirmPasswordController::class, "confirm"]);

Route::middleware(["auth", "security:auth"])->group(function () {
    Route::get("/home", [ProductController::class, "home"])->name("home");
    Route::get("/dashboard", function() {
        return view("dashboard");
    })->name("dashboard");

    // Carrito — rutas autenticadas
    Route::delete('/cart/{productId}/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/cart/{productId}/remove-all', [CartController::class, 'removeAll'])->name('cart.remove-all');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

    // Rutas de productos
    Route::resource("products", ProductController::class)->except([
        "show",
        "update",
    ]);
    Route::get("productos", [ProductController::class, "index"])->name(
        "productos.index",
    );
    Route::get("productos/agregar", [ProductController::class, "create"])->name(
        "productos.create",
    );
    Route::get("products/data", [ProductController::class, "dataTable"])->name(
        "products.data",
    );
    Route::get("products/{product}/download-image", [
        ProductController::class,
        "downloadImage",
    ])->name("products.download-image");

    // Rutas de empresas
    Route::resource('companies', CompanyController::class)->except(['show', 'update']);
    Route::get('companies/data', [CompanyController::class, 'dataTable'])->name('companies.data');

    // Rutas de usuarios (Solo Admin)
    Route::middleware(["role:admin"])->group(function () {
        Route::resource("users", UserController::class)->except([
            "show",
            "update",
        ]);
        Route::get("users/data", [UserController::class, "dataTable"])->name(
            "users.data",
        );
        Route::get("users/{user}/download-avatar", [
            UserController::class,
            "downloadAvatar",
        ])->name("users.download-avatar");
    });

    // Rutas de Pagos
    Route::name('payment.')->prefix('payment')->group(function () {
        Route::get('/checkout', [PaymentController::class, 'showCheckout'])->name('checkout');
        Route::get('/confirmation/{orderId}', [PaymentController::class, 'confirmation'])->name('confirmation');
        Route::get('/my-orders', [PaymentController::class, 'myOrders'])->name('my-orders');

        // Stripe routes
        Route::get('/stripe', [PaymentController::class, 'showStripeCheckout'])->name('stripe');
        Route::post('/create-intent', [PaymentController::class, 'createStripeIntent'])->name('create-intent');
        Route::post('/process-stripe', [PaymentController::class, 'processStripePayment'])->name('process-stripe');

        // PayPal routes
        Route::get('/paypal', [PaymentController::class, 'showPayPalCheckout'])->name('paypal');
        Route::post('/process-paypal', [PaymentController::class, 'processPayPalPayment'])->name('process-paypal');

        // Bank transfer routes
        Route::get('/bank', [PaymentController::class, 'showBankCheckout'])->name('bank');
        Route::post('/process-bank', [PaymentController::class, 'processBankPayment'])->name('process-bank');

        // Thermal receipt printing (opens in new tab, browser handles print)
        Route::get('/print-receipt/{orderId}', [ReceiptController::class, 'print'])->name('print-receipt');
    });

});
