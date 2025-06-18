<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('payment', [PaymentController::class, 'index'])->name('payment.index');
Route::get('payment/tambah', [PaymentController::class, 'create'])->name('payment.create');
Route::post('/payment/tambah', [PaymentController::class, 'store'])->name('payment.store');
Route::get('/payment/update/{id}', [PaymentController::class, 'edit'])->name('payment.edit');
Route::post('/payment/update/{id}', [PaymentController::class, 'update'])->name('payment.update');
Route::post('/payment/{id}', [PaymentController::class, 'destroy'])->name('payment.destroy');


