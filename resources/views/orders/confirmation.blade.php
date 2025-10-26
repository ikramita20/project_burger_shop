@extends('layouts.app')

@section('title', 'Confirmation de commande')

@section('content')
<div class="row">
    <div class="col-12 text-center py-5">
        <i class="bi bi-check-circle-fill text-success fs-1"></i>
        <h1 class="fw-bold mt-3">Merci pour votre commande!</h1>
        <p class="lead">Votre commande #{{ $order->id }} a bien été enregistrée.</p>
        
        <div class="card mx-auto mt-4" style="max-width: 500px;">
            <div class="card-header bg-danger text-white">
                <h4 class="fw-bold mb-0 text-white">Détails de la commande</h4>
            </div>
            <div class="card-body text-start">
                <div class="mb-3">
                    <h5 class="fw-bold">Numéro de commande:</h5>
                    <p>#{{ $order->id }}</p>
                </div>
                
                <div class="mb-3">
                    <h5 class="fw-bold">Date:</h5>
                    <p>{{ $order->created_at->format('d/m/Y H:i') }}</p>
                </div>
                
                <div class="mb-3">
                    <h5 class="fw-bold">Adresse de livraison:</h5>
                    <p>{{ $order->delivery_address }}</p>
                </div>
                
                <div class="mb-3">
                    <h5 class="fw-bold">Total:</h5>
                    <p class="fw-bold text-danger fs-4">{{ number_format($order->total_price, 2) }} €</p>
                </div>
                
                <div class="alert alert-info mt-4">
                    <i class="bi bi-info-circle"></i> Le paiement s'effectuera en espèces à la livraison.
                </div>
            </div>
        </div>
        
        <a href="{{ route('home') }}" class="btn btn-danger mt-4">Retour à l'accueil</a>
    </div>
</div>
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
    
    body {
        background-color: white;
    }
    
    .card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }
    
    .card-header {
        background-color: var(--primary) !important;
        color: white !important;
        font-weight: 600;
        letter-spacing: 0.5px;
        padding: 1.25rem;
    }
    
    .card-body {
        padding: 1.5rem;
    }
    
    .text-success {
        color: #28a745 !important;
        font-size: 4rem !important;
    }
    
    h1 {
        color: var(--primary);
        font-weight: 700;
        margin-bottom: 1rem;
    }
    
    .lead {
        font-size: 1.25rem;
        color: var(--dark);
    }
    
    .btn-danger {
        background-color: var(--primary);
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        padding: 0.75rem 2rem;
        transition: all 0.3s ease;
    }
    
    .btn-danger:hover {
        background-color: #A0101A;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(193, 18, 31, 0.3);
        color: white;
    }
    
    .alert-info {
        background-color: rgba(247, 127, 0, 0.1);
        border-left: 3px solid var(--secondary);
        color: var(--dark);
        border-radius: 8px;
    }
    
    .alert-info i {
        color: var(--secondary);
        margin-right: 0.5rem;
    }
    
    .fs-4 {
        color: var(--primary);
    }
    
    @media (max-width: 768px) {
        .text-success {
            font-size: 3rem !important;
        }
        
        h1 {
            font-size: 2rem;
        }
        
        .card {
            margin: 0 1rem;
        }
    }
</style>
@endsection