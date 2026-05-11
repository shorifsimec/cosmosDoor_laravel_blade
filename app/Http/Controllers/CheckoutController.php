<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }
        return view('checkout.index', compact('cart'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'address' => 'required|string',
        ]);

        $cart = session()->get('cart', []);
        $totalPrice = array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);

        Order::create([
            'user_id' => Auth::id() ?? 1, // Defaulting to 1 if not logged in for simplicity
            'products' => json_encode($cart),
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        session()->forget('cart');
        return redirect()->route('home')->with('success', 'Order placed successfully!');
    }
}
