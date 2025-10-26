<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Notifications\OrderReceived;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function checkout()
    {
        $cart = session()->get('cart', []);
        
        return empty($cart) 
            ? redirect()->route('home')->with('error', 'Votre panier est vide!')
            : view('orders.checkout', compact('cart'));
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('home')->with('error', 'Votre panier est vide!');
        }

        $validatedData = $this->validateOrderData($request);
        $order = $this->createOrder($validatedData, $cart);
        $this->createOrderItems($order, $cart);
        $this->notifyVendor($order);

        session()->forget('cart');
        return redirect()->route('order.confirmation', $order);
    }

    protected function validateOrderData(Request $request): array
    {
        return $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'delivery_address' => 'required|string|max:500',
            'notes' => 'nullable|string|max:1000',
        ]);
    }

    protected function createOrder(array $data, array $cart): Order
    {
        return Order::create([
            'user_id' => Auth::id(),
            'customer_name' => $data['customer_name'],
            'customer_phone' => $data['customer_phone'],
            'delivery_address' => $data['delivery_address'],
            'total_price' => $this->calculateTotal($cart),
            'notes' => $data['notes'],
            'status' => 'pending',
        ]);
    }

    protected function calculateTotal(array $cart): float
    {
        return array_reduce($cart, fn($sum, $item) => $sum + ($item['price'] * $item['quantity']), 0);
    }

    protected function createOrderItems(Order $order, array $cart): void
{
    $ingredientMap = [
        1 => 'Brioche',
        2 => 'Sésame',
        3 => 'Complet',
        4 => 'Boeuf',
        5 => 'Poulet',
        6 => 'Végétarien',
        7 => 'Cheddar',
        8 => 'Emmental',
        9 => 'Bleu',
        10 => 'Laitue',
        11 => 'Tomate',
        12 => 'Oignon',
        13 => 'Cornichon',
        14 => 'Bacon',
        15 => 'Ketchup',
        16 => 'Mayonnaise',
        17 => 'Barbecue',
        18 => 'Biggy'
    ];

    foreach ($cart as $item) {
        
        $ingredients = $item['ingredients'] ?? [];
        $ingredientNames = array_map(function($id) use ($ingredientMap) {
            return $ingredientMap[$id] ?? 'Inconnu';
        }, $ingredients);

        OrderItem::create([
            'order_id' => $order->id,
            'burger_id' => $item['burger_id'] ?? null,
            'burger_name' => $item['name'],
            'price' => $item['price'],
            'ingredients' => json_encode($ingredientNames), 
            'quantity' => $item['quantity'],
        ]);
    }
}

protected function notifyVendor(Order $order)
{
    $order->load('items');

    $lines = [
        "=== Commande #{$order->id} ===",
        "Client: {$order->customer_name}",
        "Téléphone: {$order->customer_phone}",
        "Adresse: {$order->delivery_address}",
        "Date: " . now()->format('d/m/Y H:i'),
        ""
    ];

    foreach ($order->items as $item) {
        $lines[] = "{$item->quantity}x {$item->burger_name} - " . number_format($item->price * $item->quantity, 2) . "€";
        
        $ingredients = json_decode($item->ingredients, true);
        if (!empty($ingredients)) {
            $lines[] = "   (" . implode(', ', $ingredients) . ")";
        }
    }

    $lines[] = "";
    $lines[] = "TOTAL: " . number_format($order->total_price, 2) . "€";
    $lines[] = "Notes: " . ($order->notes ?: 'Aucune');
    $lines[] = str_repeat('=', 30);

    Storage::disk('public')->append('commandes.txt', implode("\n", $lines));
}
    public function confirmation(Order $order)
    {
        return view('orders.confirmation', compact('order'));
    }
}