<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Truncating the tables before seeding
        
        DB::table('categories')->truncate();
        DB::table('products')->truncate();
        DB::table('carts')->truncate();
        DB::table('users')->truncate();

        // Running seeders
        User::factory()->count(10)->create();
        $this->call(CategorySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(CartSeeder::class);
    }
}
