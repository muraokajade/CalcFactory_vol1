<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecipeSeeder extends Seeder
{

    public function run()
    {
         DB::table('recipes')->insert([
            [
                'cake_id' => 1,
                'ingredient_id' => 1,
                // 'name' => 'チョコ',
                'amount' => 100,
                // 'number' => 30,
                // 'price'は要りません//リレーションでとってくる
 
            ],
            [
                'cake_id' => 1,
                'ingredient_id' => 1,
                // 'name' => 'チョコ',
                'amount' => 200,
                // 'number' => 30,
                // 'price'は要りません//リレーションでとってくる
 
            ],
            [
                'cake_id' => 1,
                'ingredient_id' => 1,
                // 'name' => 'チョコ',
                'amount' => 300,
                // 'number' => 30,
                // 'price'は要りません//リレーションでとってくる
 
            ],
           
            
        ]);
            
    }
}
