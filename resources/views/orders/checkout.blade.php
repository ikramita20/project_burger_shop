@extends('layouts.app')

@section('title', 'Finaliser la commande')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="fw-bold display-5">Finaliser la commande</h1>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-dark-red text-white py-3">
                    <h4 class="fw-bold mb-0 text-white"><i class="bi bi-truck me-2"></i>Informations de livraison</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('order.store') }}" method="POST">
                        @csrf
                        
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label for="customer_name" class="form-label fw-bold">Nom complet <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-person text-muted"></i></span>
                                    <input type="text" class="form-control" id="customer_name" name="customer_name" 
                                        value="{{ auth()->user() ? auth()->user()->name : '' }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="customer_phone" class="form-label fw-bold">Téléphone <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-telephone text-muted"></i></span>
                                    <input type="tel" class="form-control" id="customer_phone" name="customer_phone" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="delivery_address" class="form-label fw-bold">Adresse de livraison <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-geo-alt text-muted"></i></span>
                                <textarea class="form-control" id="delivery_address" name="delivery_address" rows="3" required></textarea>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="notes" class="form-label fw-bold">Notes supplémentaires</label>
                            <textarea class="form-control" id="notes" name="notes" rows="3" 
                                placeholder="Instructions spéciales, allergies, etc."></textarea>
                            <div class="form-text">Optionnel</div>
                        </div>
                        
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="terms" required>
                            <label class="form-check-label" for="terms">
                                J'accepte les <a href="#" class="text-dark-red">conditions générales de vente</a> <span class="text-danger">*</span>
                            </label>
                        </div>
                        
                        <div class="alert bg-light-orange border-start border-3 border-dark-red mb-4">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-info-circle-fill text-dark-red fs-4 me-3"></i>
                                <div>Le paiement s'effectuera en espèces à la livraison.</div>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-dark-red btn-lg w-100 py-3 fw-bold">
                            <i class="bi bi-check-circle me-2"></i>Confirmer la commande
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header bg-dark-red text-white py-3">
                    <h4 class="fw-bold mb-0 text-white"><i class="bi bi-receipt me-2"></i>Récapitulatif</h4>
                </div>
                <div class="card-body p-4">
                    @php
                        $subtotal = 0;
                        foreach($cart as $item) {
                            $subtotal += $item['price'] * $item['quantity'];
                        }
                        $deliveryFee = 2.50;
                        $total = $subtotal + $deliveryFee;
                    @endphp
                    
                    <div class="border-bottom-light pb-3 mb-3">
                        @foreach($cart as $item)
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">{{ $item['name'] }} ×{{ $item['quantity'] }}</span>
                            <span class="fw-medium">{{ number_format($item['price'] * $item['quantity'], 2) }} €</span>
                        </div>
                        @endforeach
                    </div>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span>Sous-total</span>
                        <span>{{ number_format($subtotal, 2) }} €</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span>Frais de livraison</span>
                        <span>{{ number_format($deliveryFee, 2) }} €</span>
                    </div>
                    <div class="d-flex justify-content-between fw-bold fs-5 mt-4 pt-2">
                        <span>Total TTC</span>
                        <span class="text-dark-red">{{ number_format($total, 2) }} €</span>
                    </div>
                </div>
            </div>
        </div>
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
    .bg-dark-red {
        background-color: var(--primary) !important;
    }

    .text-dark-red {
        color: var(--primary) !important;
    }

    .bg-light-orange {
        background-color: rgba(247, 127, 0, 0.1) !important;
    }

    .border-bottom-light {
        border-bottom: 1px solid rgba(0, 0, 0, 0.08) !important;
    }

    .card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
    }

    .card-header {
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .form-label {
        margin-bottom: 0.5rem;
    }

    .form-control, .form-select, .input-group-text {
        border: 2px solid #e9ecef;
        border-radius: 8px !important;
    }

    .input-group-text {
        background-color: var(--light);
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--secondary);
        box-shadow: 0 0 0 0.2rem rgba(247, 127, 0, 0.25);
    }

    .btn-dark-red {
        background-color: var(--primary);
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }

    .btn-dark-red:hover {
        background-color: #A0101A;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(193, 18, 31, 0.3);
    }

    .alert {
        border-radius: 8px;
    }

    .form-check-input:checked {
        background-color: var(--primary);
        border-color: var(--primary);
    }

    a {
        text-decoration: none;
        transition: all 0.2s ease;
    }

    a:hover {
        text-decoration: underline;
        color: #A0101A !important;
    }

    @media (max-width: 768px) {
        .card-header, .card-body {
            padding: 1.25rem;
        }
    }
</style>
@endsection
