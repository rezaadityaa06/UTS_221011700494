<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EcoProduct extends Model
{
    protected $fillable = ['name', 'material', 'price', 'eco_rating', 'image', 'description'];

    protected function casts(): array
    {
        return ['price' => 'decimal:2', 'eco_rating' => 'integer'];
    }
}
