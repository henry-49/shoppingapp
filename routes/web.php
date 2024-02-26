<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SliderController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

/* Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
}); */

Route::get('/admin', [AdminController::class, 'admin']);

// CategoryController group routes
Route::controller(CategoryController::class)->group(function ()  {
    Route::get('/addcategory', 'addcategory');
    Route::post('/savecategory',  'savecategory');
    Route::get('/categories',  'categories');
    Route::get('/edit_category/{id}',  'editcategory');
    Route::post('/updatecategory',  'updatecategory');
    Route::get('/delete_category/{id}',  'deletecategory');
});

Route::get('/addslider', [SliderController::class, 'addslider']);
Route::get('/sliders', [SliderController::class, 'sliders']);

Route::get('/addproduct', [ProductController::class, 'addproduct']);
Route::get('/products', [ProductController::class, 'products']);
Route::post('/saveproduct', [ProductController::class, 'saveproduct'])->name('saveproduct');
Route::get('/edit_product/{id}', [ProductController::class, 'editproduct']);
Route::post('/updateproduct', [ProductController::class, 'updateproduct'])->name('updateproduct');
Route::get('/delete_product/{id}', [ProductController::class, 'deleteproduct']);
Route::get('/unactivate_product/{id}', [ProductController::class, 'unactivate_product']);
Route::get('/activate_product/{id}', [ProductController::class, 'activate_product']);



Route::get('/', [ClientController::class, 'home']);
Route::get('/shop', [ClientController::class, 'shop'])->name('shop');
Route::get('/cart', [ClientController::class, 'cart'])->name('cart');
Route::get('/checkout', [ClientController::class, 'checkout'])->name('checkout');
Route::get('/login', [ClientController::class, 'login'])->name('login');
Route::get('/signup', [ClientController::class, 'signup'])->name('signup');
Route::get('/orders', [ClientController::class, 'orders'])->name('orders');

/* Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php'; */