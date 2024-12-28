<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController; 

Route::get('/', function () {
    return view('welcome');
})->name('login');
Route::get('/signup', function () {
    return view('signup');
})->name('sign');
Route::post('/signingup', [userController::class,'save'])->name('signingup');
Route::get('/dashboard', [userController::class,'data'])->name('dash');
Route::post('/login', [userController::class,'logined'])->name('logged');
Route::post('/admin/approve/{user}', [userController::class, 'approveUser'])->name('admin.approve');

Route::post('{product}', [userController::class, 'approveProduct'])->name('adminproduct');


Route::get('/add-product', [userController::class, 'create'])->name('product.create');
Route::post('/add-product', [userController::class, 'store'])->name('product.store');

