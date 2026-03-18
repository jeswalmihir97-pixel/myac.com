<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;
use App\Models\User;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('svalue');
});
//login authinction 

Route::get('/register', [AuthController::class, 'showRegister'])->name('login');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/dashboard', function () {
    if (!session('user_id')) {
        return redirect('/login');
    }

    $user = User::find(session('user_id'));
    return view('dashboard', ['user' => $user]);
});
Route::get('/dashboard', [ProductController::class, 'dashboard'])->name('dashboard');
// Cart routes
Route::post('/cart/add/{id}', [CartController::class, 'addToCart']);
Route::get('/cart', [CartController::class, 'viewCart']);
Route::post('/cart/update/{id}', [CartController::class, 'updateCart']);
Route::get('/cart/remove/{id}', [CartController::class, 'removeFromCart']);
// Buy Now
Route::post('/buy-now/{id}', [CartController::class, 'buyNow'])->name('buynow');
// Checkout routes (auth required)
Route::middleware(['auth'])->group(function () {
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::post('/place-order', [CartController::class, 'storeOrder'])->name('place.order');
    Route::get('/invoice/{id}', [CartController::class, 'invoice'])->name('invoice.show');
});
Route::get('user/search', [ProductController::class, 'search'])->name('product.search');
// Wishlist
Route::middleware(['auth'])->group(function () {
    Route::get('user/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('wishlist/add/{id}', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::get('wishlist/remove/{id}', [WishlistController::class, 'remove'])->name('wishlist.remove');
});
Route::get('/user/orders', [WishlistController::class, 'myOrders'])->name('user.orders');
Route::get('/about', function () { return view('about');});
Route::get('/contact', function () { return view('contact');});


//admin login 
Route::get('/admin/dashboard', function () {
    if (session('is_admin') != 1) {
        return redirect('/login')->with('error', 'Access denied.');
    }

    $user = Auth::user(); // already logged in via Auth
    return view('admin.dashboard', compact('user'));
});
Route::get('/admin/dashboard', [ProductController::class, 'adminDashboard']);
Route::get('admin/stock', [ProductController::class, 'stock'])->name('admin.stock');
Route::post('/stock/update/{id}', [ProductController::class, 'updateStock'])->name('admin.stock.update');
Route::get('admin/add-product', [ProductController::class, 'create']);
Route::post('admin/save-product', [ProductController::class, 'store']);



