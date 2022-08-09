<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    
        public function run()
    {
         DB::table('products')->insert([
            [
                'name' => 'チョコレートケーキ',
                'information' => 'うまい',
                'raw_price' => '100',
                'sell_price' => '300',
                'cost' => '50',
                // 'category' => '洋菓子'
                
            ],
            [
                'name' => 'ショートケーキ',
                'information' => 'うまい',
                'raw_price' => '100',
                'sell_price' => '300',
                'cost' => '50',
                // 'category' => '洋菓子'
                
            ],
             
           
            
        ]);
}}
