<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\productControllers;
use App\Http\Controllers\cartControllers;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderControllers;
use App\Http\Controllers\categoryControllers;
use App\Http\Controllers\brandController;
use App\Http\Controllers\productfeedbackControllers;
use App\Http\Controllers\userControllers;
use App\Http\Controllers\adminControlllers;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\emailverifyuserControllers;
use App\Http\Controllers\OrderdetailControllers;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/', [productControllers::class, 'index'])->name('home');
Route::get('/products/{id}', [productControllers::class, 'showdetail'])->name('product.detail');
Route::get('/products', [productControllers::class, 'index']);
Route::get('/search', [productControllers::class, 'search'])->name('search');
Route::post('/products/{id}/add-to-cart', [productControllers::class, 'addToCart'])->name('product.add_to_cart');
Route::get('/getSizes', [productControllers::class, 'getSizes'])->name('getSizes');

Route::get('/products/brand/{brandId}', [brandController::class, 'filterByBrand'])->name('product.filterByBrand');
Route::get('/categories/{categoryId}', [categoryControllers::class, 'filterByCategory'])->name('categories.filter');

Route::get('/cart', [cartControllers::class, 'index'])->name('cart.index');
Route::post('/cart/add', [cartControllers::class, 'add'])->name('cart.add');
Route::delete('/cart/{id}', [cartControllers::class, 'remove'])->name('cart.remove');
Route::get('/get-sizes/{colorId}', [cartControllers::class, 'getSizes']);

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);
Route::get('verify-email/{token}', [RegisterController::class, 'verifyEmail'])->name('verify-email');


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('auth/google', [LoginController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [LoginController::class, 'handleGoogleCallback']);

Route::get('/products/search', [productControllers::class, 'search'])->name('products.search');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/change-password', [ProfileController::class, 'showChangePasswordForm'])->name('change.password.form');
    Route::post('/change-password', [ProfileController::class, 'changePassword'])->name('change.password');
   
});
Route::get('forgot-password', [RegisterController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [RegisterController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [RegisterController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [RegisterController::class, 'reset'])->name('password.update');

Route::middleware(['auth'])->group(function () {
    Route::get('products/{product}/feedback', [productfeedbackControllers::class, 'create'])->name('product_feedback.create');
    Route::post('products/{product}/feedback', [productfeedbackControllers::class, 'store'])->name('product_feedback.store');
    Route::get('products/{id}', [productfeedbackControllers::class, 'showRatings'])->name('product.detail');
    //Route::get('product-feedback/{id}', [App\Http\Controllers\productfeedbackControllers::class, 'show'])->name('product-feedback.show');
   
   
});

//Route::get('/product/{id}', [productfeedbackControllers::class, 'show'])->name('product.show');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/order', [OrderControllers::class, 'create'])->name('order.create');
    Route::post('/order/store', [OrderControllers::class, 'store'])->name('order.store');
    Route::get('/order/success', [OrderControllers::class, 'success'])->name('order.success');
});

Route::get('/checkout', [OrderControllers::class, 'show'])->name('product.checkout');
Route::post('/checkout', [OrderControllers::class, 'placeOrder'])->name('checkout.placeOrder');
Route::get('/order-success', [OrderControllers::class, 'success'])->name('checkout.success');

Route::middleware(['auth'])->group(function () {
    Route::get('/orders/{orderId}/details', [OrderControllers::class, 'showOrderDetails'])->name('orders.details');
    Route::get('orders/{id}', [OrderControllers::class, 'showOrderDetails'])->name('orders.details');
});
Route::get('order-details/{id}', [OrderdetailControllers::class, 'show'])->name('order-details.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'showw'])->name('profile.show');
});
Route::prefix('admin')->group(function () {
    Route::get('login', [App\Http\Controllers\Admin\adminControlllers::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [App\Http\Controllers\Admin\adminControlllers::class, 'login'])->name('admin.login.post');
    Route::post('logout', [App\Http\Controllers\Admin\adminControlllers::class, 'logout'])->name('admin.logout');


});
Route::middleware('auth:admin')->group(function () {
    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardsController::class, 'index'])->name('admin.dashboard');
    Route::resource('user', App\Http\Controllers\Admin\usercontrollers::class);
    Route::resource('category', App\Http\Controllers\Admin\CategorysController::class);
    Route::resource('brand', App\Http\Controllers\Admin\BrandsController::class);
    Route::resource('color', App\Http\Controllers\Admin\ColorsController::class);
    Route::resource('size', App\Http\Controllers\Admin\SizesController::class);
    Route::resource('order', App\Http\Controllers\Admin\OrdersController::class);
    Route::resource('product', App\Http\Controllers\Admin\ProductsController::class);
    Route::get('add-color-size/{id}', [App\Http\Controllers\Admin\ProductsController::class, 'add_color_size'])->name('add-color-size');
    Route::get('product/{productId}/colors', [App\Http\Controllers\Admin\ProductsController::class, 'showdetail'])->name('show-product-colors');
    Route::post('store-size-color/{id}', [App\Http\Controllers\Admin\ProductsController::class, 'store_size_color'])->name('store-size-color');
    Route::delete('delete-size-color/{id}', [App\Http\Controllers\Admin\ProductsController::class, 'delete_size_color'])->name('delete-size-color');
    Route::post('update-order/{id}', [App\Http\Controllers\Admin\OrdersController::class, 'update_order'])->name('update-order');
    //Statistical
    Route::post('/days-order', [App\Http\Controllers\Admin\StatisticalController::class, 'days_order'])->name('days_order');
    Route::post('/dashboard-filter', [App\Http\Controllers\Admin\StatisticalController::class, 'dashboard_filter'])->name('dashboard_filter');
    Route::post('/filter-by-date', [App\Http\Controllers\Admin\StatisticalController::class, 'filter_by_date'])->name('filter_by_date');
    //Mail
    Route::get('test-mail', [App\Http\Controllers\Admin\OrdersController::class, 'test_mail'])->name('test-mail');
});