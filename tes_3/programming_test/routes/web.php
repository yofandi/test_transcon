<?php

use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/programming', TransactionController::class);

Route::get('/transaction/{id}/details', [TransactionController::class, 'getTransactionDetails'])->name('transaction.details');
Route::delete('/transaction/detail/delete', [TransactionController::class, 'deleteItem'])->name('transaction.detail.delete');
