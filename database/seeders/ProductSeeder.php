<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['product_category_id' => 1, 'name' => 'Milla', 'slug' => 'milla', 'price' => 3.99, 'image' => 'product-1.png', 'description' => 'Smooth-texture flour blend, suitable for swallow and porridge.', 'available' => 1],
            ['product_category_id' => 1, 'name' => 'MOAT', 'slug' => 'moat', 'price' => 2.45, 'image' => 'product-2.png', 'description' => 'Quick-cook, high-fiber blend for blended drinks and porridges.', 'available' => 1],
            ['product_category_id' => 4, 'name' => 'NutriCore', 'slug' => 'nutricore', 'price' => 0, 'image' => 'product-3.png', 'description' => 'Coming soon: high-protein, multigrain mix.', 'available' => 0],
            ['product_category_id' => 2, 'name' => 'Teff Gold', 'slug' => 'teff-gold', 'price' => 4.50, 'image' => 'product-4.png', 'description' => 'Gluten-free Teff blend for traditional recipes.', 'available' => 1],
            ['product_category_id' => 3, 'name' => 'Millet Magic', 'slug' => 'millet-magic', 'price' => 5.25, 'image' => 'product-5.png', 'description' => 'Nutritionally optimized millet flour for health-conscious users.', 'available' => 1],
            ['product_category_id' => 3, 'name' => 'Oat Plus', 'slug' => 'oat-plus', 'price' => 3.75, 'image' => 'product-6.png', 'description' => 'Oat-based flour blend for breakfast porridges and baking.', 'available' => 1],
        ];

        foreach ($products as $product) {
            DB::table('products')->insert([
                'product_category_id' => $product['product_category_id'],
                'name' => $product['name'],
                'slug' => $product['slug'],
                'price' => $product['price'],
                'image' => $product['image'],
                'description' => $product['description'],
                'available' => $product['available'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
