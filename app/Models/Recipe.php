<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ingredients;
use App\Models\Cake;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'cake_id',
        'ingredient_id',
        'amount',

    ];

    public function ingredient()
    {
        return $this->belongsTo(Ingredients::class);
    }

    public function cake()
    {
        return $this->belongsTo(Cake::class);
    }
}
