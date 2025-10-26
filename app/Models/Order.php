<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'customer_name', 'customer_phone', 
        'delivery_address', 'total_price', 'status', 'notes'
    ];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
