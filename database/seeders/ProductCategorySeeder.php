<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Heritage Flour Blends', 'slug' => Str::slug('Heritage Flour Blends'), 'description' => 'Traditional and modern flour blends from heritage grains.'],
            ['name' => 'Gluten-Free Options', 'slug' => Str::slug('Gluten-Free Options'), 'description' => 'Wheat-free blends for special dietary needs.'],
            ['name' => 'Specialty Mixes', 'slug' => Str::slug('Specialty Mixes'), 'description' => 'Targeted nutritional or cooking purposes.'],
            ['name' => 'Coming Soon', 'slug' => Str::slug('Coming Soon'), 'description' => 'Products under development, not yet available.'],
        ];

        foreach ($categories as $category) {
            DB::table('product_categories')->insert([
                'name' => $category['name'],
                'slug' => $category['slug'],
                'description' => $category['description'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
