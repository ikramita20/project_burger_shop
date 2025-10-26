<?php

namespace Database\Seeders;

use App\Models\Burger;
use App\Models\Ingredient;
use Illuminate\Database\Seeder;

class BurgerSeeder extends Seeder
{
    public function run()
    {
        // Ingrédients
        $ingredients = [
            // Pains
            ['name' => 'Brioche', 'price' => 1.00, 'category' => 'pain'],
            ['name' => 'Sésame', 'price' => 1.20, 'category' => 'pain'],
            ['name' => 'Complet', 'price' => 1.50, 'category' => 'pain'],
            
            // Viandes
            ['name' => 'Boeuf', 'price' => 3.00, 'category' => 'viande'],
            ['name' => 'Poulet', 'price' => 2.50, 'category' => 'viande'],
            ['name' => 'Végétarien', 'price' => 2.80, 'category' => 'viande'],
            
            // Fromages
            ['name' => 'Cheddar', 'price' => 1.00, 'category' => 'fromage'],
            ['name' => 'Emmental', 'price' => 1.20, 'category' => 'fromage'],
            ['name' => 'Bleu', 'price' => 1.50, 'category' => 'fromage'],
            
            // Garnitures
            ['name' => 'Laitue', 'price' => 0.50, 'category' => 'garniture'],
            ['name' => 'Tomate', 'price' => 0.60, 'category' => 'garniture'],
            ['name' => 'Oignon', 'price' => 0.40, 'category' => 'garniture'],
            ['name' => 'Cornichon', 'price' => 0.50, 'category' => 'garniture'],
            ['name' => 'Bacon', 'price' => 1.50, 'category' => 'garniture'],
            
            // Sauces
            ['name' => 'Ketchup', 'price' => 0.30, 'category' => 'sauce'],
            ['name' => 'Mayonnaise', 'price' => 0.30, 'category' => 'sauce'],
            ['name' => 'Barbecue', 'price' => 0.40, 'category' => 'sauce'],
            ['name' => 'Biggy', 'price' => 0.50, 'category' => 'sauce'],
        ];

        foreach ($ingredients as $ingredient) {
            Ingredient::create($ingredient);
        }

        // Burgers prédéfinis
        $burgers = [
            [
                'name' => 'Classic Burger',
                'description' => 'Notre burger classique avec viande de boeuf, cheddar, laitue et sauce maison',
                'base_price' => 6.50,
                'is_customizable' => true,
                'ingredients' => [
                    ['Brioche', true],
                    ['Boeuf', true],
                    ['Cheddar', true],
                    ['Laitue', true],
                    ['Tomate', true],
                    ['Oignon', false],
                    ['Ketchup', true],
                ]
            ],
            [
                'name' => 'Chicken Burger',
                'description' => 'Burger au poulet croustillant avec emmental et sauce barbecue',
                'base_price' => 7.00,
                'is_customizable' => true,
                'ingredients' => [
                    ['Sésame', true],
                    ['Poulet', true],
                    ['Emmental', true],
                    ['Laitue', true],
                    ['Tomate', true],
                    ['Barbecue', true],
                ]
            ],
            [
                'name' => 'Veggie Burger',
                'description' => 'Burger végétarien avec galette de légumes et fromage bleu',
                'base_price' => 7.50,
                'is_customizable' => true,
                'ingredients' => [
                    ['Complet', true],
                    ['Végétarien', true],
                    ['Bleu', true],
                    ['Laitue', true],
                    ['Tomate', true],
                    ['Oignon', true],
                    ['Mayonnaise', true],
                ]
            ]
        ];

        foreach ($burgers as $burgerData) {
            $ingredients = $burgerData['ingredients'];
            unset($burgerData['ingredients']);
            
            $burger = Burger::create($burgerData);
            
            foreach ($ingredients as $ingredient) {
                $ing = Ingredient::where('name', $ingredient[0])->first();
                $burger->ingredients()->attach($ing->id, ['is_default' => $ingredient[1]]);
            }
        }
    }
}
