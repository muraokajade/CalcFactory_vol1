<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CakeSeeder extends Seeder
{

        public function run()
    {
         DB::table('cakes')->insert([
            [
                'name' => 'ショートケーキ',
                'raw_price' => 300,
                'number' => 30,

            ],
            [
                'name' => 'チョコレートケーキ',
                'raw_price' => 300,
                'number' => 20,
            ],
            [
                'name' => '旭南オリジナル',
                'raw_price' => 300,
                'number' => 10,

            ],


        ]);
}}
