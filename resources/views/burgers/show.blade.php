@extends('layouts.app')

@section('title', 'Personnaliser ' . $burger->name)

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold text-dark mb-3">Personnaliser : {{ $burger->name }}</h1>
        <div class="divider mx-auto my-3"></div>
        <p class="text-muted">Modifiez les ingrédients selon vos préférences</p>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <form action="{{ route('cart.add') }}" method="POST" id="customBurgerForm">
                @csrf
                <input type="hidden" name="burger_id" value="{{ $burger->id }}">
                <input type="hidden" name="is_custom" value="1">
                <input type="hidden" name="base_price" value="{{ $basePrice }}">
                <input type="hidden" name="ingredients" value="">
                <input type="hidden" name="image_url" value="{{ $burger->image_url }}">

                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-header bg-dark-red text-white py-3">
                        <h4 class="fw-bold mb-0 text-white"><i class="bi bi-info-circle me-2"></i> Burger Original</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{ $burger->image_url }}" 
                                alt="{{ $burger->name }}"
                                class="img-fluid burger-image"
                                style="height: 250px; object-fit: cover;"
                                onerror="this.onerror=null;this.src='{{ asset('images/default-burger.jpg') }}'">
                            </div>
                            <div class="col-md-8">
                                <h5 class="fw-bold">{{ $burger->name }}</h5>
                                <p class="text-muted">{{ $burger->description }}</p>
                                <div class="d-flex align-items-center">
                                    <span class="fw-bold me-2">Prix :</span>
                                    <span class="text-dark-red fw-bold">{{ number_format($burger->base_price, 2) }} €</span>
                                </div>
                                <div class="mt-2">
                                    <span class="fw-bold me-2">Ingrédients :</span>
                                    @foreach($burger->ingredients as $ingredient)
                                        <span class="badge bg-light text-dark border">{{ $ingredient->name }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-header bg-dark-red text-white py-3">
                        <h4 class="fw-bold mb-0 text-white"><i class="bi bi-list-check me-2"></i> Personnalisation</h4>
                    </div>
                    <div class="card-body">
                        @foreach($ingredientsByCategory as $category => $ingredients)
                        <div class="mb-5">
                            <h5 class="fw-bold text-orange mb-4 d-flex align-items-center">
                                <span class="category-icon me-2">
                                    @if($category === 'pain') <i class="bi bi-bread-slice"></i>
                                    @elseif($category === 'viande') <i class="bi bi-droplet"></i>
                                    @elseif($category === 'fromage') <i class="bi bi-square"></i>
                                    @elseif($category === 'sauce') <i class="bi bi-droplet-half"></i>
                                    @elseif($category === 'garniture') <i class="bi bi-flower1"></i>
                                    @else <i class="bi bi-plus-circle"></i>
                                    @endif
                                </span>
                                {{ ucfirst($category) }}
                            </h5>
                            <div class="row g-3">
                                @foreach($ingredients as $ingredient)
                                <div class="col-md-6">
                                    <div class="form-check-card p-3 rounded border position-relative">
                                        <input class="form-check-input" type="checkbox" 
                                            id="ingredient-{{ $ingredient->id }}" 
                                            name="ingredients[]"
                                            value="{{ $ingredient->id }}"
                                            data-price="{{ $ingredient->price }}"
                                            data-name="{{ $ingredient->name }}"
                                            @if(in_array($ingredient->id, $defaultIngredients)) checked @endif>
                                        <label class="form-check-label ms-3 w-100" for="ingredient-{{ $ingredient->id }}">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="d-block fw-bold">{{ $ingredient->name }}</span>
                                                <span class="badge bg-orange text-white">+{{ number_format($ingredient->price, 2) }}€</span>
                                            </div>
                                            @if($ingredient->description)
                                            <small class="text-muted d-block mt-1">{{ $ingredient->description }}</small>
                                            @endif
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="burgerName" class="form-label fw-bold">Nom de votre version</label>
                                <input type="text" class="form-control form-control-lg border-dark" 
                                    id="burgerName" name="name" 
                                    value="{{ $customName }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Quantité</label>
                                <div class="input-group input-group-lg">
                                    <button class="btn btn-outline-dark-red" type="button" id="decrement">
                                        <i class="bi bi-dash"></i>
                                    </button>
                                    <input type="number" name="quantity" 
                                        class="form-control text-center border-dark" 
                                        value="1" min="1" id="quantity">
                                    <button class="btn btn-outline-dark-red" type="button" id="increment">
                                        <i class="bi bi-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-lg sticky-lg-top" style="top: 20px;">
                <div class="card-header bg-dark-red text-white py-3">
                    <h4 class="fw-bold mb-0 text-white"><i class="bi bi-receipt me-2"></i> Récapitulatif</h4>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <div class="burger-preview-container">
                            <img src="{{ $burger->image_url }}" 
                            alt="{{ $burger->name }}"
                            class="img-fluid burger-image"
                            style="height: 250px; object-fit: cover;"
                            onerror="this.onerror=null;this.src='{{ asset('images/default-burger.jpg') }}'">
                        </div>
                    </div>
                    <h5 id="summaryName" class="fw-bold mb-3">{{ $customName }}</h5>
                    
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3 text-dark">Ingrédients :</h6>
                        <div id="summaryIngredients" class="ingredients-list">
                            @foreach($burger->ingredients as $ingredient)
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span>{{ $ingredient->name }}</span>
                                <span class="text-orange fw-bold">+{{ number_format($ingredient->price, 2) }}€</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center mb-4 pt-3 border-top">
                        <span class="fw-bold fs-5">Total :</span>
                        <span class="fw-bold text-dark-red fs-3" id="summaryPrice">{{ number_format($basePrice, 2) }} €</span>
                    </div>
                    
                    <button type="submit" class="btn btn-dark-red btn-lg w-100 py-3 fw-bold" form="customBurgerForm">
                        <i class="bi bi-cart-plus me-2"></i> Ajouter au panier
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    :root {
        --dark-red: #8B0000;
        --orange: #FFA500;
        --light-orange: rgba(255, 165, 0, 0.1);
    }
    body {
        background-color: white;
    }
    .bg-dark-red {
        background-color: #C1121F;
    }
    
    .text-dark-red {
        color: #C1121F;
    }
    
    .bg-orange {
        background-color: var(--orange);
    }
    
    .text-orange {
        color: var(--orange);
    }
    
    .btn-dark-red {
        background-color: #C1121F;
        border-color: #C1121F;
        color: white;
    }
    
    .btn-dark-red:hover {
        background-color: #C1121F;
        border-color: #C1121F;
        color: white;
    }
    
    .btn-outline-dark-red {
        color: #C1121F;
        border-color: #C1121F;
    }
    
    .btn-outline-dark-red:hover {
        background-color: #C1121F;
        color: white;
    }
    
    .form-check-card {
        transition: all 0.3s ease;
        cursor: pointer;
        border: 1px solid #dee2e6;
        background-color: white;
    }

    .form-check-card:hover {
        border-color: var(--orange) !important;
        background-color: var(--light-orange);
        transform: translateY(-2px);
    }

    .form-check-input:checked ~ .form-check-label {
        color: #C1121F;
    }

    .form-check-input:checked {
        background-color: #C1121F;
        border-color: var(--dark-red);
    }
    
    .form-check-input:checked ~ .form-check-label .badge {
        background-color: #C1121F !important;
    }

    .form-check-input:focus {
        box-shadow: 0 0 0 0.25rem rgba(139, 0, 0, 0.25);
    }

    .ingredients-list {
        max-height: 200px;
        overflow-y: auto;
        padding-right: 10px;
    }

    .ingredients-list::-webkit-scrollbar {
        width: 5px;
    }

    .ingredients-list::-webkit-scrollbar-thumb {
        background-color: #C1121F;
        border-radius: 10px;
    }

    .divider {
        height: 4px;
        width: 80px;
        background: var(--orange);
        margin: 1rem auto;
        border-radius: 2px;
    }

    .card-header {
        border-bottom: none;
    }
    
    .border-dark {
        border-color: white !important;
    }
    
    .burger-preview-container {
        background: white;
        border-radius: 8px;
        padding: 15px;
        border: 1px dashed #dee2e6;
    }
    
    .category-icon {
        color: var(--orange);
        font-size: 1.2rem;
    }
    
    .sticky-lg-top {
        position: -webkit-sticky;
        position: sticky;
        top: 20px;
        z-index: 10;
    }
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const quantityInput = document.getElementById('quantity');
    const decrementBtn = document.getElementById('decrement');
    const incrementBtn = document.getElementById('increment');
    const checkboxes = document.querySelectorAll('.form-check-input');
    const summaryName = document.getElementById('summaryName');
    const summaryIngredients = document.getElementById('summaryIngredients');
    const summaryPrice = document.getElementById('summaryPrice');
    const burgerNameInput = document.getElementById('burgerName');
    const burgerPreview = document.getElementById('burgerPreview');
    const form = document.getElementById('customBurgerForm');

    [decrementBtn, incrementBtn].forEach(btn => {
        btn.addEventListener('click', () => {
            let value = parseInt(quantityInput.value);
            if(btn === decrementBtn && value > 1) quantityInput.value = value - 1;
            if(btn === incrementBtn) quantityInput.value = value + 1;
        });
    });

    burgerNameInput.addEventListener('input', () => {
        summaryName.textContent = burgerNameInput.value || "{{ $customName }}";
    });

    function updateSummary() {
        let total = {{ $basePrice }};
        let ingredientsHTML = '';
        let selectedIngredients = [];
        
        checkboxes.forEach(checkbox => {
            if(checkbox.checked) {
                const price = parseFloat(checkbox.dataset.price);
                const name = checkbox.dataset.name;
                total += price;
                selectedIngredients.push(name);
                
                ingredientsHTML += `
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span>${name}</span>
                        <span class="text-orange fw-bold">+${price.toFixed(2)}€</span>
                    </div>`;
            }
        });

        summaryIngredients.innerHTML = ingredientsHTML || '<p class="text-muted mb-0">Aucun ingrédient sélectionné</p>';
        summaryPrice.textContent = `${total.toFixed(2)} €`;
        
        form.querySelector('input[name="base_price"]').value = total;
        form.querySelector('input[name="ingredients"]').value = JSON.stringify(selectedIngredients);
    }

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const card = this.closest('.form-check-card');
            if(this.checked) {
                card.classList.add('border-orange');
                card.style.backgroundColor = 'var(--light-orange)';
            } else {
                card.classList.remove('border-orange');
                card.style.backgroundColor = '';
            }
            updateSummary();
        });
    });

    form.addEventListener('submit', function(e) {
        if(document.querySelectorAll('.form-check-input:checked').length === 0) {
            e.preventDefault();
            alert('Veuillez sélectionner au moins un ingrédient');
        }
    });

    updateSummary();
});
</script>
@endsection
