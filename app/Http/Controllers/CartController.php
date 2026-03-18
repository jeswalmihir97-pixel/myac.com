<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Add product to cart
    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        $qty = max(1, (int) $request->qty);

        if (isset($cart[$id])) {
            $cart[$id]['qty'] += $qty;
        } else {
            $cart[$id] = [
                'name' => $product->product_name,
                'price' => $product->product_price,
                'image' => $product->product_image,
                'qty' => $qty,
            ];
        }

        session()->put('cart', $cart);
        // If AJAX request
        if ($request->ajax()) {
            return response()->json([
                'message' => 'Product added to cart!',
                'cartCount' => collect($cart)->sum('qty')
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    // View cart
    public function viewCart()
    {
        $cart = session()->get('cart', []);
        $grandTotal = collect($cart)->sum(fn($i) => $i['price'] * $i['qty']);
        return view('cart', compact('cart', 'grandTotal'));
    }

    // Update cart
    public function updateCart(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        if(isset($cart[$id])) {
            $cart[$id]['qty'] = max(1, (int)$request->qty);
            session()->put('cart', $cart);
        }
        return response()->json([
        'message' => 'Cart updated successfully!',
        'cartCount' => collect($cart)->sum('qty')]);
    }

    // Remove from cart
    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Item removed!');
    }

    // Buy Now
    public function buyNow(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $qty = max(1, (int)$request->input('qty', 1));

        session(['buy_now_cart' => [
            $id => [
                'name' => $product->product_name,
                'price' => $product->product_price,
                'image' => $product->product_image,
                'qty' => $qty
            ]
        ]]);

        // Redirect to login if not logged in
        if (!Auth::check()) {
            session(['url.intended' => route('checkout')]);
            return redirect()->route('login')->with('info', 'Please login to continue checkout.');
        }

        return redirect()->route('checkout');
    }

    // Checkout page
    public function checkout()
    {
        $user = Auth::user();

        $cart = session('buy_now_cart', session('cart', []));
        $buy_now = session()->has('buy_now_cart'); // FIX: lowercase with underscore

        if (empty($cart)) {
            return redirect()->route('dashboard')->with('error', 'No items to checkout!');
        }

        $grandTotal = collect($cart)->sum(fn($i) => $i['price'] * $i['qty']);

        return view('checkout', compact('user', 'cart', 'grandTotal', 'buy_now')); // pass correct name
    }


    // Store Order
    public function storeOrder(Request $request)
    {
        $cart = $request->has('buy_now') ? session('buy_now_cart', []) : session('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Your cart is empty!');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:30',
            'address' => 'required|string',
            'payment_method' => 'required|in:COD,Card,UPI',
        ]);

        $deliveryDays = 5; // example fixed delivery, can be dynamic

        $order = Order::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'total' => collect($cart)->sum(fn($i) => $i['price'] * $i['qty']),
            'payment_method' => $request->payment_method,
            'status' => 'confirmed',
            'delivery_date' => now()->addDays($deliveryDays),
        ]);

        foreach ($cart as $id => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $item['qty'],
                'price' => $item['price'],
            ]);
        }

        // Clear session
        if ($request->has('buy_now')) {
            session()->forget('buy_now_cart');
        } else {
            session()->forget('cart');
        }

        return redirect()->route('invoice.show', $order->id)
                         ->with('success', 'Order placed successfully!');
    }

    // Invoice
    public function invoice($id)
    {
        $order = Order::with('items.product')->findOrFail($id);
        return view('invoice', compact('order'));
    }

}
