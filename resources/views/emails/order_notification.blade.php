<!DOCTYPE html>
<html>
<head>
    <title>Nouvelle commande #{{ $order->id }}</title>
</head>
<body>
    <h1>Nouvelle commande #{{ $order->id }}</h1>
    <p><strong>Date:</strong> {{ $date }}</p>
    
    <h2>Informations client</h2>
    <p><strong>Nom:</strong> {{ $order->customer_name }}</p>
    <p><strong>Téléphone:</strong> {{ $order->customer_phone }}</p>
    <p><strong>Adresse:</strong> {{ $order->delivery_address }}</p>
    <p><strong>Notes:</strong> {{ $order->notes ?? 'Aucune' }}</p>
    
    <h2>Détails de la commande</h2>
    <ul>
        @foreach($items as $item)
        <li>
            {{ $item->burger_name }} × {{ $item->quantity }}
            - {{ number_format($item->price * $item->quantity, 2) }} €
        </li>
        @endforeach
    </ul>
    
    <p><strong>Total:</strong> {{ number_format($order->total_price, 2) }} €</p>
</body>
</html>