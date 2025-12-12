<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EffetController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NatureActionController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TechniquePoseController;
use Illuminate\Support\Facades\Route;

// -----------------------------------------
// PAGE D’ACCUEIL PUBLIQUE
// -----------------------------------------
Route::view('/', 'home')->name('home');
Route::get('/accueil', [HomeController::class, 'showAccueilScreen'])->name('accueil');

// -----------------------------------------
// AUTHENTIFICATION
// -----------------------------------------
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// -----------------------------------------
// ADMIN AREA (protégé par middleware : admin)
// -----------------------------------------
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Enregistrement supplémentaires
    Route::post('/products/technique/store', [TechniquePoseController::class, 'store'])->name('technique.save.store');
    Route::post('/products/effet/store', [EffetController::class, 'store'])->name('effet.save.store');
    Route::post('/products/nature/store', [NatureActionController::class, 'store'])->name('nature.save.store');

    // CRUD Products / Orders / Clients
    Route::resource('/products', ProductController::class)->names('products');
    Route::resource('/orders', OrderController::class)->names('orders');
    Route::resource('/clients', ClientController::class)->names('clients');
});

// -----------------------------------------
// CLIENT AREA (protégé par middleware : client)
// -----------------------------------------
Route::middleware(['auth', 'client'])->prefix('client')->name('client.')->group(function () {

    Route::get('/accueil', [ClientController::class, 'home'])->name('accueil');

    // Dashboard client
    Route::get('/dashboard', [ClientController::class, 'dashboard'])->name('dashboard');

    // Détail d’un produit (avec route model binding)
    Route::get('/produits/{product}', [ClientController::class, 'showProduct'])->name('product.show');

    // Catalogue
    Route::get('/produits', [ClientController::class, 'listProducts'])->name('catalogue');
});
