@extends('layouts.app')

@section('title', 'Personnaliser votre Burger')

@section('content')
<div class="custom-burger-wrapper">
    <div class="custom-header text-center">
        <h1>Créez votre <span>Burger Signature</span></h1>
        <p class="subtitle">Composez chaque couche avec vos ingrédients préférés</p>
        <div class="header-divider"></div>
    </div>

    <div class="custom-builder-container">
        <div class="ingredients-panel">
            <form action="{{ route('cart.add') }}" method="POST" id="customBurgerForm">
                @csrf
                <input type="hidden" name="burger_id" value="">
                <input type="hidden" name="is_custom" value="1">
                <input type="hidden" name="base_price" value="0">
                <input type="hidden" name="ingredients" value="">
                @if(isset($burger))
                <input type="hidden" name="image_url" value="{{ $burger->image_url }}">
                @else
                <input type="hidden" name="image_url" value="{{ asset('images/default-burger.jpg') }}">
                @endif

                <div class="ingredient-categories">
                    @foreach($ingredientsByCategory as $category => $ingredients)
                    <div class="category-section">
                        <div class="category-title">
                            <div class="category-icon">
                                @switch($category)
                                    @case('pain') 🍞 @break
                                    @case('viande') 🍗 @break
                                    @case('fromage') 🧀 @break
                                    @case('sauce') 🥫 @break
                                    @case('crudités') 🥗 @break
                                    @default ✨
                                @endswitch
                            </div>
                            <h3>{{ ucfirst($category) }}</h3>
                        </div>
                        
                        <div class="ingredient-options">
                            @foreach($ingredients as $ingredient)
                            <div class="ingredient-option">
                                <input type="checkbox" 
                                       id="ingredient-{{ $ingredient->id }}" 
                                       name="ingredients[]"
                                       value="{{ $ingredient->id }}"
                                       data-price="{{ $ingredient->price }}"
                                       data-name="{{ $ingredient->name }}">
                                <label for="ingredient-{{ $ingredient->id }}">
                                    <span class="ingredient-name">{{ $ingredient->name }}</span>
                                    <span class="ingredient-price">+{{ number_format($ingredient->price, 2) }}€</span>
                                    @if($ingredient->description)
                                    <span class="ingredient-desc">{{ $ingredient->description }}</span>
                                    @endif
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="burger-options">
                    <div class="option-group">
                        <label for="burgerName">Nommez votre création</label>
                        <input type="text" id="burgerName" name="name" value="Mon Burger Unique" required>
                    </div>
                    
                    <div class="option-group">
                        <label>Quantité</label>
                        <div class="quantity-control">
                            <button type="button" id="decrement">−</button>
                            <input type="number" name="quantity" value="1" min="1" id="quantity">
                            <button type="button" id="increment">+</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="summary-panel">
            <div class="summary-details">
                <h2>Votre <span>Composition</span></h2>
                
                <div class="ingredients-summary" id="summaryIngredients">
                    <p class="empty-message">Commencez à ajouter des ingrédients</p>
                </div>
                
                <div class="price-summary">
                    <span>Total :</span>
                    <span class="total-price" id="summaryPrice">0.00 €</span>
                </div>
                
                <button type="submit" form="customBurgerForm" class="add-to-cart-btn">
                    <span class="btn-icon">🛒</span>
                    <span class="btn-text">Ajouter au panier</span>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
:root {
    --primary: #FF5A5F; 
    --secondary: #00A896; 
    --accent: #F7B267; 
    --dark: #2D3047; 
    --light: #F8F7F2; 
    --gray: #6D7275; 
}

.custom-burger-wrapper {
    background-color: white;
    min-height: 100vh;
    padding: 2rem 0;
}

.custom-header {
    margin-bottom: 3rem;
}

.custom-header h1 {
    font-size: 3rem;
    font-weight: 800;
    color: var(--dark);
    margin-bottom: 0.5rem;
}

.custom-header h1 span {
    color: #C1121F;
    position: relative;
}

.subtitle {
    font-size: 1.2rem;
    color: var(--gray);
    margin-bottom: 1.5rem;
}

.header-divider {
    width: 150px;
    height: 4px;
    background-color: #F77F00;
    margin: 0 auto;
    border-radius: 2px;
}

.custom-builder-container {
    display: flex;
    max-width: 1400px;
    margin: 0 auto;
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    overflow: hidden;
}

.ingredients-panel {
    flex: 1.5;
    padding: 2rem;
    background: white;
    border-right: 1px solid rgba(0,0,0,0.05);
}

.summary-panel {
    flex: 1;
    display: flex;
    flex-direction: column;
    padding: 2rem;
    background: linear-gradient(135deg, var(--light), white);
}

.summary-details {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.summary-details h2 {
    font-size: 1.8rem;
    color: var(--dark);
    margin-bottom: 1.5rem;
}

.summary-details h2 span {
    color: #F77F00;
}

.ingredient-categories {
    max-height: 65vh;
    overflow-y: auto;
    padding-right: 1rem;
}

.category-section {
    margin-bottom: 2.5rem;
}

.category-title {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.5rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px dashed rgba(0,0,0,0.1);
}

.category-icon {
    font-size: 1.8rem;
    width: 50px;
    height: 50px;
    background: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 3px 10px rgba(0,0,0,0.05);
}

.category-title h3 {
    margin: 0;
    font-size: 1.3rem;
    color: var(--dark);
}

.ingredient-options {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 1rem;
}

.ingredient-option {
    position: relative;
}

.ingredient-option input[type="checkbox"] {
    position: absolute;
    opacity: 0;
}

.ingredient-option label {
    display: flex;
    flex-direction: column;
    padding: 1rem;
    background: white;
    border-radius: 10px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.05);
    cursor: pointer;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.ingredient-option label:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.ingredient-option input[type="checkbox"]:checked + label {
    border-color: var(--accent);
    background-color: rgba(247, 178, 103, 0.05);
}

.ingredient-name {
    font-weight: 600;
    color: var(--dark);
    margin-bottom: 0.3rem;
}

.ingredient-price {
    color:#F77F00;
    font-weight: 700;
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
}

.ingredient-desc {
    color: var(--gray);
    font-size: 0.8rem;
    line-height: 1.4;
}

.burger-options {
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 2px dashed rgba(0,0,0,0.1);
}

.option-group {
    margin-bottom: 1.5rem;
}

.option-group label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 600;
    color: var(--dark);
}

.option-group input[type="text"] {
    width: 100%;
    padding: 0.8rem 1rem;
    border: 1px solid rgba(0,0,0,0.1);
    border-radius: 8px;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.option-group input[type="text"]:focus {
    outline: none;
    border-color: var(--secondary);
    box-shadow: 0 0 0 3px rgba(0, 168, 150, 0.1);
}

.quantity-control {
    display: flex;
    align-items: center;
}

.quantity-control input {
    width: 60px;
    text-align: center;
    padding: 0.8rem 0;
    margin: 0 0.5rem;
    border: 1px solid rgba(0,0,0,0.1);
    border-radius: 8px;
}

.quantity-control button {
    width: 40px;
    height: 40px;
    background: white;
    border: 1px solid rgba(0,0,0,0.1);
    border-radius: 8px;
    font-size: 1.2rem;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.quantity-control button:hover {
    background: #F77F00;
    color: white;
    border-color: #F77F00;
}

.ingredients-summary {
    flex-grow: 1;
    max-height: 200px;
    overflow-y: auto;
    margin: 1.5rem 0;
    padding-right: 1rem;
}

.ingredients-summary .empty-message {
    color: var(--gray);
    font-style: italic;
    text-align: center;
    margin-top: 2rem;
}

.ingredient-item {
    display: flex;
    justify-content: space-between;
    padding: 0.7rem 0;
    border-bottom: 1px dashed rgba(0,0,0,0.1);
}

.price-summary {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem 0;
    border-top: 2px dashed rgba(0,0,0,0.1);
    font-size: 1.3rem;
    font-weight: 700;
}

.price-summary .total-price {
    color: #F77F00;
}

.add-to-cart-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1rem;
    width: 100%;
    padding: 1.2rem;
    background: #F77F00;
    color: white;
    border: none;
    border-radius: 10px;
    font-size: 1.1rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
}

.add-to-cart-btn:hover {
    background: #e66a00;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(247, 127, 0, 0.3);
}

.btn-icon {
    font-size: 1.3rem;
}

@keyframes ingredientAdded {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

.ingredient-added {
    animation: ingredientAdded 0.3s ease;
}

@media (max-width: 1200px) {
    .custom-builder-container {
        flex-direction: column;
    }
    
    .ingredients-panel {
        border-right: none;
        border-bottom: 1px solid rgba(0,0,0,0.05);
    }
}

@media (max-width: 768px) {
    .ingredient-options {
        grid-template-columns: 1fr;
    }
    
    .custom-header h1 {
        font-size: 2.2rem;
    }
}
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const quantityInput = document.getElementById('quantity');
    const decrementBtn = document.getElementById('decrement');
    const incrementBtn = document.getElementById('increment');
    const checkboxes = document.querySelectorAll('.ingredient-option input[type="checkbox"]');
    const summaryName = document.getElementById('summaryName');
    const summaryIngredients = document.getElementById('summaryIngredients');
    const summaryPrice = document.getElementById('summaryPrice');
    const burgerNameInput = document.getElementById('burgerName');
    const form = document.getElementById('customBurgerForm');

    [decrementBtn, incrementBtn].forEach(btn => {
        btn.addEventListener('click', () => {
            let value = parseInt(quantityInput.value);
            if(btn === decrementBtn && value > 1) quantityInput.value = value - 1;
            if(btn === incrementBtn) quantityInput.value = value + 1;
        });
    });

    burgerNameInput.addEventListener('input', () => {
        summaryName.textContent = burgerNameInput.value || "Mon Burger Unique";
    });

    function updateSummary() {
        let total = 0;
        let ingredientsHTML = '';
        let selectedIngredients = [];
        
        checkboxes.forEach(checkbox => {
            if(checkbox.checked) {
                const price = parseFloat(checkbox.dataset.price);
                const name = checkbox.dataset.name;
                total += price;
                selectedIngredients.push(name);
                
                ingredientsHTML += `
                    <div class="ingredient-item">
                        <span>${name}</span>
                        <span class="ingredient-price">+${price.toFixed(2)}€</span>
                    </div>`;
            }
        });

        if (ingredientsHTML === '') {
            summaryIngredients.innerHTML = '<p class="empty-message">Commencez à ajouter des ingrédients</p>';
        } else {
            summaryIngredients.innerHTML = ingredientsHTML;
        }
        
        summaryPrice.textContent = `${total.toFixed(2)} €`;
        
        form.querySelector('input[name="base_price"]').value = total;
        form.querySelector('input[name="ingredients"]').value = JSON.stringify(selectedIngredients);
    }

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                const label = this.nextElementSibling;
                label.classList.add('ingredient-added');
                setTimeout(() => {
                    label.classList.remove('ingredient-added');
                }, 300);
            }
            updateSummary();
        });
    });

    form.addEventListener('submit', function(e) {
        if(document.querySelectorAll('.ingredient-option input[type="checkbox"]:checked').length === 0) {
            e.preventDefault();
            alert('Veuillez sélectionner au moins un ingrédient');
        }
    });

    updateSummary();
});
</script>
@endsection