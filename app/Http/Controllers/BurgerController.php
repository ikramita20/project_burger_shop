<?php

namespace App\Http\Controllers;

use App\Models\Burger;
use App\Models\Ingredient;
use Illuminate\Support\Facades\Storage;

class BurgerController extends Controller
{
    public function index()
{
    $burgers = Burger::with('ingredients')->get()->each(function($burger) {
        $burger->image_url = $burger->image_url; // Force le calcul
    });
    
    return view('burgers.index', compact('burgers'));
}

    public function show(Burger $burger)
    {
        // Vérification robuste de l'image
        $imagePath = 'images/burgers/'.$burger->image;
        $imageUrl = file_exists(public_path($imagePath)) 
            ? asset($imagePath) 
            : asset('images/default-burger.jpg');

        return view('burgers.show', [
            'burger' => $burger,
            'image_url' => $imageUrl,
            'ingredientsByCategory' => Ingredient::all()->groupBy('category'),
            'defaultIngredients' => $burger->ingredients->pluck('id')->toArray(),
            'basePrice' => $burger->base_price,
            'customName' => "Ma version de ".$burger->name
        ]);
    }

    public function custom()
    {
        return view('burgers.custom', [
            'ingredientsByCategory' => [
                'pain' => Ingredient::where('category', 'pain')->get(),
                'viande' => Ingredient::where('category', 'viande')->get(),
                'fromage' => Ingredient::where('category', 'fromage')->get(),
                'garniture' => Ingredient::where('category', 'garniture')->get(),
                'sauce' => Ingredient::where('category', 'sauce')->get(),
            ]
        ]);
    }
}