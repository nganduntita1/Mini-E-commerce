<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        $categories = Category::all(); // Fetching all categories
    
        // Checking if categories are empty and set a message
        $categoriesEmpty = $categories->isEmpty();
    
        return Inertia::render('ProductList', [
            'products' => $products,
            'categories' => $categories, // Passing categories to the view
            'categoriesEmpty' => $categoriesEmpty, // Passing the empty check to the view
        ]);
    }
}
