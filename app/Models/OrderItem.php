<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id', 'burger_id', 'burger_name', 
        'price', 'ingredients', 'quantity'
    ];

    protected $casts = [
        'ingredients' => 'array'
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function burger(): BelongsTo
    {
        return $this->belongsTo(Burger::class);
    }
    
}