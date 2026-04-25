@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center" style="background-color: transparent; border-bottom: 1px solid rgba(138, 154, 134, 0.2); font-family: 'Playfair Display', serif; color: #6C7A68; font-size: 1.5rem;">
                    <span>{{ __('messages.Welcome') }} - Catálogo de Cosmética Natural</span>
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn btn-sm" style="background-color: #8A9A86; color: white; border-radius: 30px;">
                            <i class="bi bi-house-door"></i> Ir al Dashboard
                        </a>
                    @endauth
                </div>

                <div class="card-body">
                    @guest
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle"></i> Bienvenido invitado! Explora nuestro catálogo de productos.
                        </div>
                    @else
                        <div class="alert alert-success">
                            <i class="bi bi-person-check"></i> ¡Hola, {{ Auth::user()->name }}!
                        </div>
                    @endguest

                    @if($products->count() > 0)
                        <div class="row g-4 mb-4">
                            @foreach($products as $product)
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                    <div class="card product-card h-100 shadow-sm">
                                        @if($product->image && Storage::disk('public')->exists($product->image))
                                            <img src="{{ asset('storage/' . $product->image) }}" 
                                                 class="card-img-top product-image" 
                                                 alt="{{ $product->name }}">
                                        @else
                                            <div class="product-image-placeholder">
                                                <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                                            </div>
                                        @endif
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title fw-bold">{{ $product->name }}</h5>
                                            <p class="card-text text-muted small flex-grow-1">
                                                {{ Str::limit($product->description, 80) }}
                                            </p>
                                            <div class="d-flex justify-content-between align-items-center mt-2">
                                                <span class="product-price">${{ number_format($product->price, 2) }}</span>
                                                <button class="btn btn-sm btn-cart">
                                                    <i class="bi bi-cart-plus"></i>
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
                        <div class="text-center py-5">
                            <i class="bi bi-inbox" style="font-size: 4rem; color: #6c757d;"></i>
                            <h4 class="mt-3">No hay productos disponibles</h4>
                            <p class="text-muted">Aún no se han agregado productos al catálogo.</p>
                            @auth
                                <a href="{{ route('products.create') }}" class="btn btn-primary mt-3">
                                    <i class="bi bi-plus-circle"></i> Agregar Producto
                                </a>
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap');

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
    }

    h1, h2, h3, h4, h5, .card-header span {
        font-family: 'Playfair Display', serif;
    }

    .gap-3 {
        gap: 1rem;
    }
    .d-flex {
        display: flex;
    }
    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
    }

    /* Product Card Styles */
    .product-card {
        transition: transform 0.4s ease, box-shadow 0.4s ease;
        border: 1px solid rgba(138, 154, 134, 0.15);
        border-radius: 12px;
        overflow: hidden;
        background-color: var(--card-bg);
    }

    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 25px rgba(138, 154, 134, 0.15) !important;
    }

    .product-image {
        height: 200px;
        object-fit: cover;
        width: 100%;
        border-bottom: 1px solid rgba(138, 154, 134, 0.05);
    }

    .product-image-placeholder {
        height: 200px;
        background-color: #F0EFE9;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .card-title {
        color: var(--primary-dark);
    }

    .product-price {
        font-size: 1.25rem;
        font-weight: 500;
        color: var(--primary-dark);
    }

    /* Cart button on product card */
    .btn-cart {
        background-color: var(--primary-color);
        border: none;
        color: white;
        border-radius: 30px;
        padding: 0.4rem 1rem;
        transition: background-color 0.2s ease;
        cursor: pointer;
    }

    .btn-cart:hover {
        background-color: var(--primary-dark);
        color: white;
    }

    /* Pagination */
    .pagination-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 1rem;
        margin-top: 2rem;
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
</style>

@endpush

@push('scripts')
<script>
    // Product browsing page - no auto-redirect needed
</script>

@endpush
