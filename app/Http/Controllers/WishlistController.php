<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Product;
use App\Models\Order;
use App\Models\Orderitem;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist:: with('product')
            ->where('user_id', Auth::id())
            ->get();

        return view('wishlist', compact('wishlists'));
    }

    public function add($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to add wishlist.');
        }

        Wishlist::firstOrCreate([
            'user_id' => Auth::id(),
            'product_id' => $id
        ]);

        return redirect()->back()->with('success', 'Product added to wishlist!');
    }

    public function remove($id)
    {
        Wishlist::where('user_id', Auth::id())->where('product_id', $id)->delete();
        return redirect()->back()->with('success', 'Removed from wishlist!');
    }
    public function myOrders()
    {
        $userId = Auth::id();

        // Fetch orders with items + products
        $orders = Order::with(['items.product'])
            ->where('user_id', $userId)
            ->oldest()
            ->get();

        return view('orders', compact('orders'));
    }

}
