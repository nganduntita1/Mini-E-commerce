<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    // Adding product to cart
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem = Cart::where('user_id', Auth::id())
                        ->where('product_id', $request->product_id)
                        ->first();

        if ($cartItem) {
            // If the product is already in the cart, update the quantity
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            // Creating a new cart entry
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
        }

    }

    // View the cart
    public function view()
    {
        $cartItems = Cart::with('product')
                        ->where('user_id', Auth::id())
                        ->get();
        return Inertia::render('CartPage', ['cartItems' => $cartItems]);
    }


    // Remove an item from the cart
    public function remove($cartItemId)
    {
        // Finding the cart item by its ID and deleting it
        $cartItem = Cart::where('id', $cartItemId)->where('user_id', Auth::id())->first();

        if ($cartItem) {
            $cartItem->delete();
        }

        
    }

    //Update cart item
    public function updateQuantity(Request $request, $cartItemId)
    {
        $cartItem = Cart::where('id', $cartItemId)
                        ->where('user_id', Auth::id())
                        ->first();

        if ($cartItem) {
            $cartItem->quantity = $request->quantity; // Updating the quantity
            $cartItem->save(); // Saving the changes
        }

        
    }
    

}
