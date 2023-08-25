<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Category();
        $category->name = 'Kemeja';
        $category->status = 'active';
        $category->save();

        \App\Models\Category::create([
            'name' => 'Jaket',
            'status' => 'active',
        ]);

        \App\Models\Category::create([
            'name' => 'T-Shirt',
            'status' => 'active',
        ]);
        \App\Models\Category::create([
            'name' => 'Sweeter',
            'status' => 'active',
        ]);
    }
}
