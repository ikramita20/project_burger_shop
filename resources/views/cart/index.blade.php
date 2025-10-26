@extends('layouts.app')

@section('title', 'Mon Panier')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h1 class="fw-bold">Mon Panier</h1>
    </div>
</div>

@if(empty($cart))
<div class="row">
    <div class="col-12 text-center py-5">
        <i class="bi bi-cart-x fs-1 text-muted"></i>
        <h3 class="text-muted mt-3">Votre panier est vide</h3>
        <a href="{{ route('home') }}" class="btn btn-danger mt-3">Voir nos burgers</a>
    </div>
</div>
@else
<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-body">
                @foreach($cart as $index => $item)
                <div class="row align-items-center mb-4 pb-4 border-bottom">
                    <div class="col-md-3">
                        <img src="{{ $item['image_url'] }}" 
                        class="img-fluid rounded cart-item-image"
                        alt="{{ $item['name'] }}"
                        onerror="this.onerror=null;this.src='{{ asset('images/default-burger.jpg') }}'">
                    </div>
                    <div class="col-md-5">
                        <h5 class="fw-bold">{{ $item['name'] }}</h5>
                        @if($item['is_custom'] && !empty($item['ingredients']))
                        <p class="text-muted small mb-1">Ingrédients:</p>
                        <ul class="small">
                            @foreach($item['ingredients'] as $ingredientId)
                            @php $ingredient = App\Models\Ingredient::find($ingredientId); @endphp
                            <li>{{ $ingredient->name }}</li>
                            @endforeach
                        </ul>
                        @endif
                    </div>
                    <div class="col-md-2">
                        <form action="{{ route('cart.update', $index) }}" method="POST">
                            @csrf
                            <div class="input-group">
                                <input type="number" name="quantity" class="form-control form-control-sm" value="{{ $item['quantity'] }}" min="1">
                                <button type="submit" class="btn btn-sm btn-outline-danger">OK</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-2 text-end">
                        <span class="fw-bold">{{ number_format($item['price'] * $item['quantity'], 2) }} €</span>
                        <form action="{{ route('cart.remove', $index) }}" method="POST" class="mt-2">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-link text-danger p-0">
                                <i class="bi bi-trash"></i> Supprimer
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header  text-white">
                <h4 class="fw-bold mb-0 text-white">Récapitulatif</h4>
            </div>
            <div class="card-body">
                @php
                    $subtotal = 0;
                    foreach($cart as $item) {
                        $subtotal += $item['price'] * $item['quantity'];
                    }
                    $deliveryFee = 2.50;
                    $total = $subtotal + $deliveryFee;
                @endphp
                
                <div class="d-flex justify-content-between mb-2">
                    <span>Sous-total</span>
                    <span>{{ number_format($subtotal, 2) }} €</span>
                </div>
                <div class="d-flex justify-content-between mb-3">
                    <span>Frais de livraison</span>
                    <span>{{ number_format($deliveryFee, 2) }} €</span>
                </div>
                <div class="d-flex justify-content-between fw-bold fs-5">
                    <span>Total</span>
                    <span>{{ number_format($total, 2) }} €</span>
                </div>
                
                <a href="{{ route('order.checkout') }}" class="btn btn-danger w-100 mt-4">
                    Passer la commande
                </a>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
@section('styles')
<style>
    :root {
        --primary: #C1121F; 
        --secondary: #F77F00; 
        --light: #F8F7F2; 
        --dark: #2D3047; 
        --gray: #6D7275; 
    }
    body{
        background-color: white;
    }

    .card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        margin: 10px 10px;
    }

    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: #C1121F;
        padding: 1.25rem;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    h1.fw-bold {
        color: var(--dark);
        position: relative;
        padding-bottom: 10px;
        margin: 10px 10px;
    }

    h1.fw-bold:after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 60px;
        height: 4px;
        background: var(--primary);
        border-radius: 2px;
    }

    .border-bottom {
        border-bottom: 1px solid rgba(0, 0, 0, 0.08) !important;
    }

    .btn-danger {
        background-color: var(--primary);
        border: none;
        border-radius: 8px;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }

    .btn-danger:hover {
        background-color: #A0101A;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(193, 18, 31, 0.3);
    }

    .btn-outline-danger {
        border-color: var(--primary);
        color: var(--primary);
    }

    .btn-outline-danger:hover {
        background-color: var(--primary);
        color: white;
    }

    .btn-link.text-danger {
        color: var(--primary) !important;
        transition: all 0.2s ease;
    }

    .btn-link.text-danger:hover {
        color: #A0101A !important;
        text-decoration: none;
    }

    .input-group .form-control {
        border: 2px solid #e9ecef;
        border-radius: 8px !important;
    }

    .input-group .btn-outline-danger {
        border-radius: 0 8px 8px 0 !important;
    }

    .text-muted {
        color: var(--gray) !important;
    }

    .small {
        font-size: 0.85rem;
    }

    ul.small {
        padding-left: 1.25rem;
        margin-bottom: 0;
    }

    ul.small li {
        color: var(--gray);
    }

    .fs-5 {
        color: var(--dark);
    }

    .bi-cart-x {
        color: var(--gray);
        opacity: 0.7;
    }

    @media (max-width: 768px) {
        .card-header {
            padding: 1rem;
        }
        
        .card-body {
            padding: 1.5rem;
        }
        
        .row.align-items-center {
            text-align: center;
        }
        
        .col-md-3 {
            margin-bottom: 1rem;
        }
    }
</style>
@endsection