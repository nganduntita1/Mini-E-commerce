<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Video Cameras'],
            ['name' => 'Photo Cameras'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}