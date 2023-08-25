<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Product::create([
            'category_id' => 1,
            'name' => 'Kemeja Flannel',
            'description' => 'Kemeja Flanel Biru',
            'sku' => Str::random(5),
            'price' => 125000,
            'status' => 'active',
            'image' => '',
        ]);
        \App\Models\Product::create([
            'category_id' => 2,
            'name' => 'Jaket Parka',
            'description' => 'Jaket Parka Gunung',
            'sku' => Str::random(5),
            'price' => 250000,
            'status' => 'active',
            'image' => '',
        ]);
        \App\Models\Product::create([
            'category_id' => 4,
            'name' => 'Sweeter Rajut',
            'description' => 'Sweeter Rajut Halus',
            'sku' => Str::random(5),
            'price' => 235000,
            'status' => 'active',
            'image' => '',
        ]);
    }
}
