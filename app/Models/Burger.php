<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;

class Burger extends Model
{
    protected $fillable = [
        'name', 
        'description', 
        'base_price', 
        'image', 
        'is_customizable'
    ];

    protected $appends = ['image_url'];

    /**
     * Relation avec les ingrédients
     */
    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany(Ingredient::class)
                    ->withPivot('is_default');
    }

    /**
     * Récupère les ingrédients par défaut
     */
    public function getDefaultIngredients()
    {
        return $this->ingredients()
                   ->wherePivot('is_default', true)
                   ->get();
    }

    /**
     * Accesseur pour l'URL de l'image
     * Gère 3 cas :
     * 1. Image spécifique dans la BDD
     * 2. Image par défaut selon l'ID
     * 3. Image de fallback générale
     */
    public function getImageUrlAttribute()
    {
       
        // Si image est null ou vide, retourner l'image par défaut
        if (empty($this->image)) {
            return asset('images/default-burger.jpg');
        }
    
        // Vérifier d'abord si l'image existe dans le stockage
        if (Storage::exists('public/burgers/'.$this->image)) {
            return Storage::url('public/burgers/'.$this->image);
        }
    
        // Vérifier dans le dossier public/images/burgers/
        $publicPath = 'images/burgers/'.$this->image;
        if (file_exists(public_path($publicPath))) {
            return asset($publicPath);
        }
    
        // Retourner l'image par défaut si rien n'est trouvé
        return asset('images/default-burger.jpg');
    }
    /**
     * Méthode de debug pour vérifier les chemins d'images
     */
    public function debugImagePath()
    {
        $imageFile = $this->image ?? ($defaultImages[$this->id] ?? null);
        $path = public_path('images/burgers/'.$imageFile);
        
        return [
            'burger_id' => $this->id,
            'database_value' => $this->image,
            'attempted_file' => $imageFile,
            'full_path' => $path,
            'file_exists' => file_exists($path),
            'resolved_url' => $this->image_url,
            'default_url' => asset('images/default-burger.jpg')
        ];
    }
    
}