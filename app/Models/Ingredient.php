<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ingredient extends Model
{
    protected $fillable = ['name', 'price', 'category', 'image'];

    public function burgers(): BelongsToMany
    {
        return $this->belongsToMany(Burger::class)->withPivot('is_default');
    }
}