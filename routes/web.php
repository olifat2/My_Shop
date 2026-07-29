<?php

use App\Http\Controllers\Admin\AdminClientController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Client\ClientOrderController;
use App\Http\Controllers\Client\ClientProfileController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EffetController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NatureActionController;
use App\Http\Controllers\TechniquePoseController;
use Illuminate\Support\Facades\Route;

// -----------------------------------------
// PAGE D’ACCUEIL PUBLIQUE
// -----------------------------------------
Route::get('/', [HomeController::class, 'showAccueilScreen'])->name('home');
Route::get('/accueil', [HomeController::class, 'showAccueilScreen'])->name('accueil');
Route::get('/produits', [HomeController::class, 'listProducts'])->name('catalogue');
Route::get('/produits/{product}', [HomeController::class, 'showProduct'])->name('product.show');

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
    Route::resource('/products', AdminProductController::class)->names('products');
    Route::resource('/orders', AdminOrderController::class)->only(['index', 'show'])->names('orders');
    Route::post('/orders/updateStatus/{id}', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::resource('/clients', AdminClientController::class)->names('clients');
});

// -----------------------------------------
// CLIENT AREA (protégé par middleware : client)
// -----------------------------------------
Route::middleware(['auth', 'client'])->prefix('client')->name('client.')->group(function () {

    Route::get('/accueil', [ClientController::class, 'home'])
        ->name('accueil');

    // Profil client
    Route::get('/profil', [ClientProfileController::class, 'show'])
        ->name('profile.show');

    Route::get('/profil/edition', [ClientProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::put('/profil', [ClientProfileController::class, 'update'])
        ->name('profile.update');

    // Catalogue
    Route::get('/produits', [ClientController::class, 'listProducts'])
        ->name('index');
    Route::get('/produits/{product}', [ClientController::class, 'showProduct'])
        ->name('product.show');

    // Panier
    Route::get('/panier', [ClientController::class, 'cart'])
        ->name('cart');
    Route::post('/panier/ajouter/{id}', [ClientController::class, 'addToCart'])
        ->name('cart.add');
    Route::post('/panier/update/{id}', [ClientController::class, 'updateCart'])
        ->name('cart.update');
    Route::delete('/panier/supprimer/{id}', [ClientController::class, 'removeFromCart'])
        ->name('cart.remove');

    Route::resource('/orders', ClientOrderController::class)
        ->only(['index', 'store', 'show'])
        ->names('orders');

    // Route::get('/orders/{id}/confirmation', [ClientOrderController::class, 'confirmation'])->name('orders.confirmation');
});
