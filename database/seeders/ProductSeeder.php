<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'product_category_id' => 1,
                'name' => 'Milla',
                'slug' => 'milla',
                'price' => 3.99,
                'variations' => ['0.5' => 2.00, '1' => 3.99],
                'image' => 'product-1.png',
                'short_description' => 'Smooth-texture flour blend.',
                'long_description' => 'Milla is a versatile flour suitable for a variety of Nigerian dishes including swallow, porridges, and baking.',
                'preparation_instructions' => 'Mix with water and cook on medium heat until thickened.',
                'preparation_link' => 'https://www.youtube.com/watch?v=OebJwb3lgPY',
                'available' => 1,
                'stock' => 10
                
            ],
            [
                'product_category_id' => 1,
                'name' => 'MOAT',
                'slug' => 'moat',
                'price' => 2.45,
                'variations' => ['0.5' => 1.25, '1' => 2.45],
                'image' => 'product-2.png',
                'short_description' => 'Quick-cook, high-fiber blend.',
                'long_description' => 'MOAT is a high-fiber blend designed for quick-cooking porridges and blended drinks, perfect for busy mornings.',
                'preparation_instructions' => 'Boil water, stir in MOAT, and cook for 5 minutes.',
                'preparation_link' => 'https://www.youtube.com/watch?v=VNEo4fbZ-Hs',
                'available' => 1,
                'stock' => 15
            ],
            [
                'product_category_id' => 4,
                'name' => 'NutriCore',
                'slug' => 'nutricore',
                'price' => 0,
                'variations' => [],
                'image' => 'product-3.png',
                'short_description' => 'Coming soon: high-protein, multigrain mix.',
                'long_description' => 'NutriCore is an upcoming high-protein, multigrain flour blend optimized for health-conscious users.',
                'preparation_instructions' => '',
                'preparation_link' => 'https://www.youtube.com/results?search_query=healthy+grain+cooking',
                'available' => 0,
                'stock' => 0
            ]
        ];

        foreach ($products as $product) {
            DB::table('products')->insert([
                'product_category_id' => $product['product_category_id'],
                'name' => $product['name'],
                'slug' => $product['slug'],
                'price' => $product['price'],
                'variations' => json_encode($product['variations']),
                'image' => $product['image'],
                'short_description' => $product['short_description'],
                'long_description' => $product['long_description'],
                'preparation_instructions' => $product['preparation_instructions'],
                'preparation_link' => $product['preparation_link'],
                'available' => $product['available'],
                'stock' => $product['stock'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}