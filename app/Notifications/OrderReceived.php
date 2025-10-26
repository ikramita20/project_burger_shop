<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class OrderReceived extends Notification
{
    use Queueable;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject("Nouvelle commande #{$this->order->id}")
            ->greeting("Bonjour,")
            ->line("Vous avez reçu une nouvelle commande de {$this->order->customer_name}.")
            ->line("Détails de la commande :")
            ->line("- Numéro : #{$this->order->id}")
            ->line("- Montant total : {$this->order->total_price} €")
            ->line("- Adresse de livraison : {$this->order->delivery_address}")
            ->line("- Téléphone client : {$this->order->customer_phone}")
            ->line("Merci de préparer cette commande rapidement !");
    }
}