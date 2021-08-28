<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Product;
// use 

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
    $product = Product::get();

    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'products' => $product
    ]);
});

Route::get('/dashboard', 'ProductController@index')->middleware(['auth', 'verified'])->name('dashboard');
Route::post('/cart/add', 'CartController@add_cart')->middleware(['auth', 'verified'])->name('add_to_cart');
Route::get('/cart/get', 'CartController@get_cart')->middleware(['auth', 'verified']);
Route::put('/cart/update/{id}', 'CartController@update_cart')->middleware(['auth', 'verified']);
Route::delete('/cart/{id}', 'CartController@delete_cart')->middleware(['auth', 'verified']);


require __DIR__.'/auth.php';
