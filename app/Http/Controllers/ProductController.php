<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Wishlist;
use DB;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    // Show add product form
    public function create()
    {
        return view('admin.add-product');
    }

    // Save product
    public function store(Request $request)
    {
        $request->validate([
            'brand_name'      => 'required|string|max:255',
            'product_name'    => 'required|string|max:255',
            'product_size'    => 'required|string|max:100',
            'product_qty'     => 'required|integer|min:1',
            'product_details' => 'required|string',
            'product_price'   => 'required|numeric|min:0',
            'product_image'   => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Upload image
        $imageName = time().'.'.$request->product_image->extension();
        $request->product_image->move(public_path('uploads/products'), $imageName);

        // Save product
        Product::create([
            'brand_name'      => $request->brand_name,
            'product_name'    => $request->product_name,
            'product_size'    => $request->product_size,
            'product_qty'     => $request->product_qty,
            'product_details' => $request->product_details,
            'product_price'   => $request->product_price,
            'product_image'   => $imageName,
        ]);

        return redirect('admin/add-product')->with('success', 'Product added successfully!');
    }
    public function dashboard()
    {
        $products = Product::oldest()->get(); // Fetch products
        return view('dashboard', compact('products'));
    }
    public function search(Request $request)
    {
        $query = $request->input('search');

        $products = Product::query();

        // Search by product name OR brand name
        if ($query) {
            $products->where('product_name', 'like', '%' . $query . '%')
                    ->orWhere('brand_name', 'like', '%' . $query . '%');
        }

        $products = $products->get();

        // Wishlist count for navbar
        $wishlistCount = 0;
        if (Auth::check()) {
             $wishlistCount = Wishlist::where('user_id', Auth::id())->count();
        }

        return view('dashboard', compact('products', 'query', 'wishlistCount'));
    }
    public function adminDashboard()
    {
        // Total orders = count of order_items table
        $totalOrders = OrderItem::count();

        // Available products = total count from products table
        $availableProducts = Product::count();

        // Available stock = total product_qty - total ordered qty
        $availableStock = Product::sum('product_qty') - \DB::table('order_items')->sum('quantity');


        // Recent orders (join with products + order_items + users if needed)
        $recentOrders = DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select(
                'order_items.id',
                'users.username as customer',
                'products.product_name as product', // FIXED
                'order_items.quantity as qty',
                'orders.status',
                'orders.created_at'
            )
            ->orderBy('orders.created_at', 'desc')
            ->take(5) // only last 5
            ->get();

        return view('admin.dashboard', compact('totalOrders', 'availableProducts', 'availableStock', 'recentOrders'));
    }
    public function stock()
    {
        $products = Product::all(); // fetch all products
        return view('admin.stock', compact('products'));
    }

    public function updateStock(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $sold = OrderItem::where('product_id', $product->id)
                        ->join('orders', 'order_items.order_id', '=', 'orders.id')
                        ->whereIn('orders.status', ['pending', 'confirmed', 'shipped', 'delivered'])
                        ->sum('order_items.quantity');
        $product->available_stock = $product->product_qty - $sold;
        $product->save();

        return redirect()->back()->with('success', 'Stock updated successfully.');
    }


}

