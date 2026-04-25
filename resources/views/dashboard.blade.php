@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h4>¡Hola, {{ Auth::user()->name }} !</h4>

                    <p>Aquí se muestra el contenido protegido para usuarios autenticados.</p>
                    
                    <div class="mt-4">
                        <a href="{{ route('products.index') }}" class="btn btn-primary">
                            <i class="bi bi-box-seam"></i> Ver Productos
                        </a>
                        <a href="{{ route('products.create') }}" class="btn btn-success">
                            <i class="bi bi-plus-circle"></i> Agregar Producto
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
