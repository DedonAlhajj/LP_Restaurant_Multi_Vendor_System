<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Auth\CustomerAuthController;
use App\Http\Controllers\FrontEnd\CartController;
use App\Http\Controllers\FrontEnd\OrderController;
use App\Http\Controllers\FrontEnd\VendorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\SellerDashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('customer.notification');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');



});


Route::middleware(['auth', 'role:Seller', 'checkSellerStatus'])->group(function () {
    Route::get('/seller/dashboard', [SellerDashboardController::class, 'index'])->name('seller.dashboard');
});

// صفحة الانتظار يجب أن تكون خارج middleware التحقق من حالة البائع حتى لا يحدث إعادة توجيه لانهائية
Route::middleware(['auth', 'role:Seller'])->group(function () {
    Route::get('/seller/waiting', [SellerController::class, 'index'])->name('seller.waiting');
});

////////////////////////////////////////frontend/////////////////////////////////////



require __DIR__.'/auth.php';
Route::get('/not-found',function(){
    return view(view: 'customer.error');
})->name('not.found');
Route::group(['prefix' => '{vendor_slug}', 'middleware' => 'check.vendor.slug'], function() {
    //Route::get('/', [VendorController::class, 'showMenu'])->name('vendor.menu');

    Route::get('/', [VendorController::class, 'welcome'])->name('vendor.welcome');
    Route::get('/index', [VendorController::class, 'index'])->name('vendor.index');
    Route::get('/menu', [VendorController::class, 'showMenu'])->name('vendor.menu');
    Route::get('/menu/product/{product_id}', [VendorController::class, 'showFoodItem'])->name('vendor.menu.fooditem');
    Route::get('/notifications', [VendorController::class, 'showNotifications'])->name('vendor.notifications');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');



    Route::middleware('guest:customer')->group(function () {
        Route::get('customer/login', [CustomerAuthController::class, 'loginForm'])->name('customer.login');
        Route::post('customer/login', [CustomerAuthController::class, 'login']);
        Route::get('customer/register', [CustomerAuthController::class, 'registerForm'])->name('customer.register');
        Route::post('customer/register', [CustomerAuthController::class, 'register']);
    });

    Route::middleware('auth:customer')->group(function () {
        Route::get('order/confirmation', [OrderController::class, 'confirmation'])->name('order.confirmation');
        Route::post('order/complete', [OrderController::class, 'completeOrder'])->name('order.complete');
    });
    Route::get('order/checkout', [OrderController::class, 'checkout'])->name('order.checkout');
});
