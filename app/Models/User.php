<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_vendor', // Ajoutez ce champ
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_vendor' => 'boolean', // Ajoutez ce cast
        ];
    }

    // Relation avec les commandes (pour les vendeurs)
    public function ordersToPrepare()
    {
        return $this->hasMany(Order::class, 'vendor_id');
    }
}