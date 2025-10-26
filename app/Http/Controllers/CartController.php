<?php

namespace App\Http\Controllers;

use App\Models\Burger;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        
        // Normalisation des URLs d'images pour les anciens items
        foreach ($cart as &$item) {
            if (!isset($item['image_url'])) {
                $item['image_url'] = $this->getBurgerImage($item);
            }
            // Conversion en URL absolue si nécessaire
            $item['image_url'] = $this->ensureAbsoluteUrl($item['image_url']);
        }
        
        session()->put('cart', $cart);
        
        return view('cart.index', compact('cart'));
    }

    public function add(Request $request)
    {
        $data = $request->validate([
            'burger_id' => 'nullable|exists:burgers,id',
            'is_custom' => 'required|boolean',
            'name' => 'required|string',
            'base_price' => 'required|numeric',
            'ingredients' => 'nullable|array',
            'quantity' => 'required|integer|min:1',
            'image_url' => 'required|string', // Champ ajouté
        ]);

        $cart = session()->get('cart', []);
        
        $price = $data['base_price'];
        
        if ($data['is_custom'] && !empty($data['ingredients'])) {
            $selectedIngredients = Ingredient::whereIn('id', $data['ingredients'])->get();
            foreach ($selectedIngredients as $ingredient) {
                $price += $ingredient->price;
            }
        }

        $cartItem = [
            'burger_id' => $data['burger_id'],
            'is_custom' => $data['is_custom'],
            'name' => $data['name'],
            'price' => $price,
            'ingredients' => $data['is_custom'] ? $data['ingredients'] : null,
            'quantity' => $data['quantity'],
            'image_url' => $data['image_url'], // Utilisation directe
        ];

        $cart[] = $cartItem;
        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Burger ajouté au panier!');
    }

    public function remove($index)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$index])) {
            unset($cart[$index]);
            session()->put('cart', array_values($cart));
        }

        return redirect()->route('cart.index')->with('success', 'Burger retiré du panier!');
    }

    public function update(Request $request, $index)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);
        
        if (isset($cart[$index])) {
            $cart[$index]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Quantité mise à jour!');
    }

    /**
     * Helper methods
     */
    private function getBurgerImage(array $item): string
    {
        if (!$item['is_custom'] && isset($item['burger_id'])) {
            $burger = Burger::find($item['burger_id']);
            return $burger ? $burger->image_url : asset('images/default-burger.jpg');
        }
        return asset('images/default-burger.jpg');
    }

    private function ensureAbsoluteUrl(string $url): string
    {
        if (str_starts_with($url, 'http') || str_starts_with($url, '/')) {
            return $url;
        }
        return asset($url);
    }
}