<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\telaPrincipalController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/register', [UsuarioController::class, 'create'])->name('register');
    Route::post('/register', [UsuarioController::class, 'store']);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/usuario/editar', [UsuarioController::class, 'edit'])->name('usuario.edit');
    Route::post('/usuario/atualizar', [UsuarioController::class, 'update'])->name('usuario.update');
    Route::get('/usuario/editar', [UsuarioController::class, 'edit'])->name('usuario.edit');
    Route::post('/cart/finalizar-compra', [CartController::class, 'finalizarCompra'])->name('cart.finalizar-compra');

});

require __DIR__.'/auth.php';

Route::get('/home', [telaPrincipalController::class,'index']);
Route::get('/produto/{produto}', [ProdutoController::class, 'show'])->name('showProduct');
Route::get('/categoria/{Categoria}', [CategoriaController::class, 'show']);
Route::post('/cart/{produto}', [CartController::class, 'post'])->name('cart.post');
Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
Route::get('/cart', [CartController::class, 'show'])->name('cart');
Route::get('/cart/{produto_id}', [CartController::class, 'showProduct'])->name('cart.product');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::get('/checkout', [CheckoutController::class, 'showCheckout'])->name('checkout.show');
Route::put('/cart/{produto_id}/update', [CartController::class, 'update'])->name('cart.update');
Route::put('/cart/{produto_id}', [CartController::class, 'update'])->name('cart.update');
Route::post('/usuario/adicionar-endereco', [UsuarioController::class, 'adicionarEndereco'])->name('usuario.adicionarEndereco');
Route::post('/usuario/update', [UsuarioController::class, 'update'])->name('usuario.update');


