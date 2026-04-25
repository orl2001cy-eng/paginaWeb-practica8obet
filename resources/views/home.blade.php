<!doctype html>
<html lang="en">

<head>
    <title>Productos - Obet's page</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-color: #FDFBF7; /* Crema muy claro */
            --primary-color: #8A9A86; /* Verde salvia */
            --primary-dark: #6C7A68;
            --accent-color: #D4A373; /* Terracota suave */
            --text-dark: #333333;
            --text-muted: #6b6b6b;
            --card-bg: #FFFFFF;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-dark);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            padding: 2rem 0;
        }

        h1, h2, h3, h4, h5, .navbar-brand {
            font-family: 'Playfair Display', serif;
        }

        .navbar {
            background-color: transparent;
            border-bottom: 1px solid rgba(138, 154, 134, 0.2);
            padding-bottom: 1rem;
            margin-bottom: 3rem !important;
        }

        .navbar-brand {
            color: var(--primary-dark) !important;
            font-size: 1.75rem;
            font-weight: 600;
        }

        .product-card {
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            border: 1px solid rgba(138, 154, 134, 0.15);
            border-radius: 12px;
            overflow: hidden;
            height: 100%;
            background-color: var(--card-bg);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 25px rgba(138, 154, 134, 0.15);
        }

        .product-image {
            height: 280px;
            object-fit: cover;
            width: 100%;
            border-bottom: 1px solid rgba(138, 154, 134, 0.05);
        }

        .product-image-placeholder {
            height: 280px;
            background-color: #F0EFE9;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card-body {
            padding: 1.5rem;
        }

        .card-title {
            font-size: 1.2rem;
            color: var(--primary-dark);
            margin-bottom: 0.5rem;
        }

        .product-price {
            font-size: 1.25rem;
            font-weight: 500;
            color: var(--primary-dark);
        }

        .page-header {
            text-align: center;
            color: var(--primary-dark);
            margin-bottom: 3.5rem;
        }

        .page-header h1 {
            font-size: 3.5rem;
            font-weight: 400;
            margin-bottom: 1rem;
            color: var(--primary-dark);
        }

        .page-header p {
            font-size: 1.1rem;
            color: var(--text-muted);
            max-width: 600px;
            margin: 0 auto;
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: white;
            border-radius: 12px;
            border: 1px dashed var(--primary-color);
        }

        .empty-state i {
            font-size: 4rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
            opacity: 0.7;
        }

        .login-btn {
            background-color: transparent;
            border: 1px solid var(--primary-color);
            padding: 0.6rem 1.5rem;
            border-radius: 30px;
            color: var(--primary-dark);
            font-weight: 500;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .login-btn:hover {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .pagination-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1rem;
            margin-top: 4rem;
            flex-wrap: wrap;
        }

        .btn-paginar {
            background: transparent;
            color: var(--primary-dark);
            border: 1px solid var(--primary-color);
            padding: 0.6rem 1.8rem;
            border-radius: 30px;
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-paginar:hover {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .btn-paginar.disabled {
            opacity: 0.4;
            pointer-events: none;
            cursor: not-allowed;
            border-color: #ccc;
            color: #999;
        }

        .pagination-info {
            color: var(--text-muted);
            padding: 0.5rem 1.2rem;
            font-size: 0.9rem;
        }

        .search-wrapper {
            max-width: 520px;
            margin: 0 auto 3.5rem auto;
        }

        .search-box {
            position: relative;
            display: flex;
            align-items: center;
        }

        .search-box .search-icon {
            position: absolute;
            left: 1.2rem;
            color: var(--primary-color);
            font-size: 1.15rem;
            pointer-events: none;
            z-index: 2;
        }

        .search-box input[type="text"] {
            width: 100%;
            padding: 0.8rem 1rem 0.8rem 3.2rem;
            border-radius: 30px;
            border: 1px solid rgba(138, 154, 134, 0.4);
            background: white;
            font-size: 1rem;
            color: var(--text-dark);
            outline: none;
            transition: all 0.3s ease;
        }

        .search-box input[type="text"]:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(138, 154, 134, 0.1);
        }

        .search-box .btn-buscar {
            position: absolute;
            right: 6px;
            background-color: var(--primary-color);
            border: none;
            border-radius: 25px;
            color: white;
            padding: 0.5rem 1.5rem;
            font-weight: 500;
            font-size: 0.9rem;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .search-box .btn-buscar:hover {
            background-color: var(--primary-dark);
        }

        .search-result-info {
            text-align: center;
            color: var(--text-muted);
            margin-bottom: 2rem;
            font-size: 0.95rem;
        }

        .btn-limpiar {
            color: var(--accent-color);
            text-decoration: underline;
            font-size: 0.9rem;
            margin-left: 0.5rem;
            cursor: pointer;
        }

        .btn-limpiar:hover {
            color: #C08A5D;
        }

        /* Cart button on product card */
        .btn-cart {
            background-color: var(--primary-color);
            border: none;
            color: white;
            border-radius: 30px;
            padding: 0.5rem 1.2rem;
            font-size: 0.85rem;
            font-weight: 500;
            transition: background-color 0.2s ease;
            cursor: pointer;
        }

        .btn-cart:hover {
            background-color: var(--primary-dark);
            color: white;
        }

        .btn-cart:active {
            transform: scale(0.97);
        }

        /* Navbar cart badge */
        .cart-nav-btn {
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
        }

        #cart-badge {
            position: absolute;
            top: -6px;
            right: -8px;
            font-size: 0.7rem;
            min-width: 18px;
            height: 18px;
            line-height: 18px;
            padding: 0 4px;
            border-radius: 50px;
            display: none;
            text-align: center;
            background-color: var(--accent-color) !important;
        }

        /* Toast notification */
        .cart-toast {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            z-index: 1100;
            min-width: 280px;
            border-radius: 8px;
            background-color: white;
            color: var(--text-dark);
            border-left: 4px solid var(--primary-color);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            animation: slideUp 0.3s ease;
            padding: 1rem 1.5rem;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        
        footer p {
            color: var(--text-muted);
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-sm mb-4">
            <div class="container">
                <a class="navbar-brand fw-bold" href="/">
                    <i class="bi bi-shop"></i> Obet's Store
                </a>
                <div class="ms-auto d-flex align-items-center gap-2">
                    @if (Route::has('login'))
                        @auth
                            {{-- Cart icon with badge --}}
                            <a href="{{ route('cart.index') }}" class="btn login-btn cart-nav-btn" id="cart-nav-link" title="Mi carrito">
                                <i class="bi bi-cart3"></i>
                                <span id="cart-badge" class="badge bg-danger">
                                    @php
                                        $cartCount = collect(session('cart', []))->sum('quantity');
                                    @endphp
                                    {{ $cartCount }}
                                </span>
                            </a>
                            <a href="{{ route('dashboard') }}" class="btn login-btn">
                                <i class="bi bi-house-door"></i> Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn login-btn me-2">
                                <i class="bi bi-box-arrow-in-right"></i> Iniciar Sesión
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn login-btn">
                                    <i class="bi bi-person-plus"></i> Registrarse
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="container">
            <div class="page-header">
                <h1>Nuestros Productos</h1>
                <p>Descubre nuestra selección de ingredientes botánicos y fórmulas puras para tu piel</p>
            </div>
            {{-- Buscador --}}
            <div class="search-wrapper">
                <form method="GET" action="/" class="search-box">
                    <i class="bi bi-search search-icon"></i>
                    <input
                        type="text"
                        name="search"
                        placeholder="Buscar producto por nombre..."
                        value="{{ $search }}"
                        autocomplete="off"
                    >
                    <button type="submit" class="btn-buscar">Buscar</button>
                </form>
            </div>

            {{-- Info de resultados cuando hay búsqueda activa --}}
            @if($search)
                <p class="search-result-info">
                    @if($products->total() > 0)
                        Se encontraron <strong>{{ $products->total() }}</strong> resultado(s) para "<strong>{{ $search }}</strong>"
                    @else
                        No se encontraron productos con "<strong>{{ $search }}</strong>"
                    @endif
                    &nbsp;·&nbsp;
                    <a href="/" class="btn-limpiar">Limpiar búsqueda</a>
                </p>
            @endif

            @if($products->count() > 0)
                <div class="row g-4">

                    @foreach($products as $product)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="card product-card shadow">
                                @if($product->image && Storage::disk('public')->exists($product->image))
                                    <img src="{{ asset('storage/' . $product->image) }}" 
                                         class="card-img-top product-image" 
                                         alt="{{ $product->name }}">
                                @else
                                    <div class="product-image-placeholder">
                                        <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                                    </div>
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title fw-bold">{{ $product->name }}</h5>
                                    <p class="card-text text-muted small">{{ Str::limit($product->description, 80) }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="product-price">${{ number_format($product->price, 2) }}</span>
                                        <button
                                            class="btn-cart"
                                            data-product-id="{{ $product->id }}"
                                            data-product-name="{{ $product->name }}"
                                            onclick="addToCart(this)"
                                            title="Añadir al carrito"
                                        >
                                            <i class="bi bi-cart-plus me-1"></i>Añadir
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Paginación con botones Anterior / Siguiente --}}
                <div class="pagination-wrapper">
                    @if($products->onFirstPage())
                        <span class="btn-paginar disabled">&#8592; Anterior</span>
                    @else
                        <a href="{{ $products->previousPageUrl() }}" class="btn-paginar">&#8592; Anterior</a>
                    @endif

                    <span class="pagination-info">
                        Página {{ $products->currentPage() }} de {{ max(1, $products->lastPage()) }}
                    </span>

                    @if($products->hasMorePages())
                        <a href="{{ $products->nextPageUrl() }}" class="btn-paginar">Siguiente &#8594;</a>
                    @else
                        <span class="btn-paginar disabled">Siguiente &#8594;</span>
                    @endif
                </div>
            @else
                <div class="empty-state">
                    @if($search)
                        <i class="bi bi-search-heart"></i>
                        <h2>No se encontraron resultados</h2>
                        <p class="text-muted">No hay productos que coincidan con "<strong>{{ $search }}</strong>".</p>
                        <a href="/" class="btn login-btn mt-3">
                            <i class="bi bi-x-circle"></i> Limpiar búsqueda
                        </a>
                    @else
                        <i class="bi bi-inbox"></i>
                        <h2>No hay productos disponibles</h2>
                        <p class="text-muted">Aún no se han agregado productos a la tienda.</p>
                        @auth
                            <a href="{{ route('products.create') }}" class="btn login-btn mt-3">
                                <i class="bi bi-plus-circle"></i> Agregar Producto
                            </a>
                        @endauth
                    @endif
                </div>
            @endif
        </div>
    </main>

    <footer class="text-center mt-5">
        <div class="container">
            <p>&copy; {{ date('Y') }} Obet's Natural. Todos los derechos reservados.</p>
        </div>
    </footer>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>

    <script>
        const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Show badge if count > 0 on page load
        (function () {
            syncBadge(parseInt(document.getElementById('cart-badge')?.textContent || '0'));
        })();

        function syncBadge(count) {
            const badge = document.getElementById('cart-badge');
            if (!badge) return;
            badge.textContent = count;
            badge.style.display = count > 0 ? 'inline-block' : 'none';
        }

        function addToCart(btn) {
            const productId   = btn.dataset.productId;
            const productName = btn.dataset.productName;

            // Disable button briefly to prevent double-click
            btn.disabled = true;

            fetch(`/cart/${productId}/add`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                },
            })
            .then(async res => {
                const data = await res.json();

                if (res.status === 401 && data.authenticated === false) {
                    // Not logged in — redirect to login page
                    window.location.href = data.redirect || '/login';
                    return;
                }

                // Success: update badge
                syncBadge(data.count);
                showToast(`"${productName}" añadido al carrito 🛒`, 'success');
                btn.disabled = false;
            })
            .catch(() => {
                showToast('Error al añadir al carrito. Intenta de nuevo.', 'danger');
                btn.disabled = false;
            });
        }

        function showToast(message, type = 'success') {
            // Remove existing toasts
            document.querySelectorAll('.cart-toast').forEach(t => t.remove());

            const toast = document.createElement('div');
            toast.className = `alert alert-${type} shadow cart-toast`;
            toast.innerHTML = message;
            document.body.appendChild(toast);

            setTimeout(() => {
                toast.style.transition = 'opacity 0.4s';
                toast.style.opacity = '0';
                setTimeout(() => toast.remove(), 400);
            }, 2800);
        }
    </script>
</body>

</html>
