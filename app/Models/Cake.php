<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ingredients;
use App\Models\Recipe;

class Cake extends Model
{
    use HasFactory;
    protected $fillable = ['name','number','raw_price','sell_price','benefit','status'];


    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }
    
    

    public function usedIngredients()
    {
        return $this->belongsToMany(Ingredients::class, 'recipes');
    }
    
    public function isUsedBy($ingredient)
    {
        $used_ingresient_ids = $this->usedIngredients->pluck('id');
        return $result = $used_ingresient_ids->contains($ingredient->id);
    }
}
