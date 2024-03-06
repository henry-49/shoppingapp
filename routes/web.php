<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PdfController;
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
Route::post('/saveslider', [SliderController::class, 'saveslider'])->name('saveslider');
Route::get('/edit_slider/{id}', [SliderController::class, 'editslider']);
Route::post('/updateslider', [SliderController::class, 'updateslider'])->name('updateslider');
Route::get('/delete_slider/{id}', [SliderController::class, 'deleteslider']);
Route::get('/unactivate_slider/{id}', [SliderController::class, 'unactivate_slider']);
Route::get('/activate_slider/{id}', [SliderController::class, 'activate_slider']);


Route::get('/addproduct', [ProductController::class, 'addproduct']);
Route::get('/products', [ProductController::class, 'products']);
Route::post('/saveproduct', [ProductController::class, 'saveproduct'])->name('saveproduct');
Route::get('/edit_product/{id}', [ProductController::class, 'editproduct']);
Route::post('/updateproduct', [ProductController::class, 'updateproduct'])->name('updateproduct');
Route::get('/delete_product/{id}', [ProductController::class, 'deleteproduct']);
Route::get('/unactivate_product/{id}', [ProductController::class, 'unactivate_product']);
Route::get('/activate_product/{id}', [ProductController::class, 'activate_product']);
Route::get('/view_product_by_category/{category_name}', [ProductController::class, 'view_product_by_category']);


Route::get('/', [ClientController::class, 'home'])->name('home');
Route::get('/shop', [ClientController::class, 'shop'])->name('shop');
Route::get('/cart', [ClientController::class, 'cart'])->name('cart');
Route::get('/add_to_cart/{id}', [ClientController::class, 'addtocart'])->name('addtocart');
Route::post('/update_qty/{id}', [ClientController::class, 'updateqty'])->name('updateqty');
Route::get('/remove_from_cart/{id}', [ClientController::class, 'removeFromCart'])->name('removeFromCart');
Route::get('/checkout', [ClientController::class, 'checkout'])->name('checkout');
Route::get('/login', [ClientController::class, 'login'])->name('login');
Route::get('/signup', [ClientController::class, 'signup'])->name('signup');
Route::post('/create_account', [ClientController::class, 'create_account'])->name('create_account');
Route::post('/access_account', [ClientController::class, 'access_account'])->name('access_account');
Route::get('/logout', [ClientController::class, 'logout'])->name('logout');
Route::post('/postcheckout', [ClientController::class, 'postcheckout'])->name('postcheckout');
Route::get('/orders', [ClientController::class, 'orders'])->name('orders');


// view PDF
Route::get('/view_pdf_order/{id}', [PdfController::class, 'view_pdf'])->name('view_pdf_order');


/* Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php'; */