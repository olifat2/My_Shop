<?php

use App\Http\Controllers\Admin\AdminClientController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Client\ClientOrderController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EffetController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NatureActionController;
use App\Http\Controllers\TechniquePoseController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

// -----------------------------------------
// PAGE D’ACCUEIL PUBLIQUE
// -----------------------------------------
$latestProducts = Product::with(['mecheExtension', 'produitCapillaire'])->get();

// Filtrer les produits avec stock >= 10 pour les mettre en vedette
$highItems = collect($latestProducts)->filter(fn($p) => $p->stock->sum('quantite') >= 10);

Route::view('/', 'home', compact('highItems'))->name('home');

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
    Route::resource('/orders', AdminOrderController::class)->names('orders');
    Route::post('/orders/updateStatus/{id}', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::resource('/clients', AdminClientController::class)->names('clients');
});

// -----------------------------------------
// CLIENT AREA (protégé par middleware : client)
// -----------------------------------------
Route::middleware(['auth', 'client'])->prefix('client')->name('client.')->group(function () {

    Route::get('/accueil', [ClientController::class, 'home'])->name('accueil');

    // Dashboard client
    Route::get('/dashboard', [ClientController::class, 'dashboard'])->name('dashboard');

    // Catalogue
    Route::get('/produits', [ClientController::class, 'listProducts'])->name('index');
    Route::get('/produits/{product}', [ClientController::class, 'showProduct'])->name('product.show');

    // Panier
    Route::get('/panier', [ClientController::class, 'cart'])->name('cart');
    Route::post('/panier/ajouter/{id}', [ClientController::class, 'addToCart'])->name('cart.add');
    Route::post('/panier/update/{id}', [ClientController::class, 'updateCart'])->name('cart.update');
    Route::delete('/panier/supprimer/{id}', [ClientController::class, 'removeFromCart'])->name('cart.remove');


    Route::resource('/orders', ClientOrderController::class)->names('orders');

    // Route::get('/orders/{id}/confirmation', [ClientOrderController::class, 'confirmation'])->name('orders.confirmation');
});
