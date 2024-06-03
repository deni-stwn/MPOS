<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductCatsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoresController;
use App\Http\Controllers\UserController;
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
    return view('welcome');
});

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class)->middleware('checkusertype');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Stores
    Route::resource('stores', StoresController::class);

    // Product
    Route::resource('products', ProductsController::class);

    // Categories
    Route::resource('categories', ProductCatsController::class);

    Route::get('/users/{id}/media/{collectionName}', [UserController::class, 'getMedia'])->name('users.media');
    Route::post('/users/media', [UserController::class, 'storeMedia'])->name('users.storeMedia');
    Route::post('/delete-file', [UserController::class, 'deleteFile'])->name('media.remove');
});


require __DIR__.'/auth.php';
