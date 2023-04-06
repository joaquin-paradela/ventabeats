<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        Product::create([
            'name' => 'Remax 610D Headset',
            'price' => 8.99,
            'description' => 'Remax 610D Headset',
            'image_path' => 'remax-610d.jpg',
            'audio_path' => 'audiesito.mp3',
            'id_coin' => 1
        ]);

        Product::create([
            'name' => 'Samsung LED TV',
            'price' => 41.99,
            'description' => 'Samsung LED TV',
            'image_path' => 'samsung-led-24.png',
            'audio_path' => 'cincosegundos.mp3',
            'id_coin' => 2
        ]);

        Product::create([
            'name' => 'Samsung Camara Digital',
            'price' => 144.99,
            'description' => 'Samsung LED TV',
            'image_path' => 'samsung-led-24.png',
            'audio_path' => 'juicio.mp3',
            'id_coin' => 2
        ]);
    }
}
