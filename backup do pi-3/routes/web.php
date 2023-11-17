<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\telaPrincipalController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CartController;


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
});

require __DIR__.'/auth.php';

Route::get('/home' , [telaPrincipalController::class,'index']);
Route::get('/produto/{produto}', [telaPrincipalController::class, 'show']);
Route::get('/categoria/{Categoria}',[CategoriaController::class, 'show']);
Route::get('/produto/{produto}', [ProdutoController::class, 'show'])->name('showProduct');
Route::post('/cart/{produto}', [CartController::class, 'post'])->name('cart.post');



