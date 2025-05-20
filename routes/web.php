<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CathegoryController;
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\AccountsLoginController;

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

// Login Route
Route::post('/accounts/login', [AccountsLoginController::class, 'authlogin'])->name('accounts.authlogin');
Route::get('/accounts/login', [AccountsLoginController::class, 'login'])->name('accounts.login');




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // Products
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

    // categories
    Route::get('/categories', [CathegoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CathegoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CathegoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id}', [CathegoryController::class, 'show'])->name('categories.show');
    Route::get('/categories/{id}/edit', [CathegoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{id}', [CathegoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}', [CathegoryController::class, 'destroy'])->name('categories.destroy');






    // Account Routes
    Route::get('/accounts', [AccountsController::class, 'index'])->name('accounts.index');
    Route::get('/accounts/create', [AccountsController::class, 'create'])->name('accounts.create');
    Route::post('/accounts', [AccountsController::class, 'store'])->name('accounts.store');
    Route::get( '/accounts/{email}/edit', [AccountsController::class, 'edit'])->name('accounts.edit');
    Route::put( '/accounts/{email}', [AccountsController::class, 'update'])->name('accounts.update');

});






require __DIR__.'/auth.php';
