<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();

        if ($categories->isEmpty()) {
            throw new \Exception("No categories found. Please seed categories first.");
        }
        
        $products = [
            [
                'name' => 'Product 1',
                'description' => 'Description for Product 1',
                'price' => 800.99,
                'category_id' => $categories->random()->id,
            ],
            [
                'name' => 'Product 2',
                'description' => 'Description for Product 2',
                'price' => 105.49,
                'category_id' => $categories->random()->id,
            ],
            [
                'name' => 'Product 3',
                'description' => 'Description for Product 3',
                'price' => 97.99,
                'category_id' => $categories->random()->id,
            ],
            [
                'name' => 'Product 4',
                'description' => 'Description for Product 4',
                'price' => 312.99,
                'category_id' => $categories->random()->id,
            ],
            [
                'name' => 'Product 5',
                'description' => 'Description for Product 5',
                'price' => 899.99,
                'category_id' => $categories->random()->id,
            ],
            [
                'name' => 'Product 6',
                'description' => 'Description for Product 6',
                'price' => 400.99,
                'category_id' => $categories->random()->id,
            ],
            [
                'name' => 'Product 7',
                'description' => 'Description for Product 7',
                'price' => 899.99,
                'category_id' => $categories->random()->id,
            ],
            [
                'name' => 'Product 8',
                'description' => 'Description for Product 8',
                'price' => 189.49,
                'category_id' => $categories->random()->id,
            ],
        ];
        
        $imageUrls = [
            'images/product1.jpeg',
            'images/product2.jpeg',
            'images/product3.jpeg',
            'images/product4.avif',
            'images/product5.jpeg',
            'images/product6.jpeg',
            'images/product7.jpg',
            'images/product8.jpg',
        ];
        
        foreach ($products as $index => $product) {
            $product['image_url'] = $imageUrls[$index % count($imageUrls)]; 
        
            Product::firstOrCreate(['name' => $product['name']], $product);
        }
        
        
        
    }
}
