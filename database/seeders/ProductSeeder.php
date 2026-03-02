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
                'preparation_link' => 'https://ajirinplace.com/milla-preparation',
                'available' => 1
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
                'preparation_link' => 'https://ajirinplace.com/moat-preparation',
                'available' => 1
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
                'preparation_link' => '',
                'available' => 0
            ],
            [
                'product_category_id' => 2,
                'name' => 'Teff Gold',
                'slug' => 'teff-gold',
                'price' => 4.50,
                'variations' => ['0.5' => 2.50, '1' => 4.50],
                'image' => 'product-4.png',
                'short_description' => 'Gluten-free Teff blend.',
                'long_description' => 'Teff Gold is a gluten-free flour blend perfect for traditional Nigerian and Ethiopian recipes.',
                'preparation_instructions' => 'Mix with water and cook to desired consistency.',
                'preparation_link' => 'https://ajirinplace.com/teff-gold-preparation',
                'available' => 1
            ],
            [
                'product_category_id' => 3,
                'name' => 'Millet Magic',
                'slug' => 'millet-magic',
                'price' => 5.25,
                'variations' => ['0.5' => 2.75, '1' => 5.25],
                'image' => 'product-5.png',
                'short_description' => 'Nutritionally optimized millet flour.',
                'long_description' => 'Millet Magic is designed for health-conscious users seeking a nutritious, versatile flour for breakfast and baking.',
                'preparation_instructions' => 'Combine with water and cook until smooth.',
                'preparation_link' => 'https://ajirinplace.com/millet-magic-preparation',
                'available' => 1
            ],
            [
                'product_category_id' => 3,
                'name' => 'Oat Plus',
                'slug' => 'oat-plus',
                'price' => 3.75,
                'variations' => ['0.5' => 1.95, '1' => 3.75],
                'image' => 'product-6.png',
                'short_description' => 'Oat-based flour for breakfast and baking.',
                'long_description' => 'Oat Plus is a versatile oat-based flour blend ideal for breakfast porridges, baking, and healthy snacks.',
                'preparation_instructions' => 'Mix with water or milk and cook for 5–7 minutes.',
                'preparation_link' => 'https://ajirinplace.com/oat-plus-preparation',
                'available' => 1
            ],
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
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}