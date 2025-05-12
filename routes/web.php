<?php

use App\Http\Controllers\DetailsController;
use App\Models\Transac;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransactionController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('navbar',function(){
    return view('navbar');
    
});

Route::get('about',function(){
    return view('about');

});
Route::get('contact',function(){
    return view('contact');

});

//USER
Route::get('/profile', [UserController::class, 'index']);
Route::get('/users/create', [UserController::class, 'create']);
Route::post('/users', [UserController::class, 'store']);
Route::get('/users/{id}/edit', [UserController::class, 'edit']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);
Route::get('/items', [UserController::class, 'show']);
//TRANSACTION

// Display transaction form
Route::get('/trans', [TransactionController::class, 'create']);
// Store transaction
Route::post('/trans/store', [TransactionController::class, 'store']);
// View all transactions
Route::get('/viewtrans', [TransactionController::class, 'index']);
// Edit transaction
Route::get('/users/{id}/edittrans', [TransactionController::class, 'edit']);
// Update transaction
//Route::put('/users/{id}', [TransactionController::class, 'update']);
// Delete transaction
//Route::delete('/users/{id}', [TransactionController::class, 'destroy']);

//Details
Route::get('/details/create',[DetailsController::class,'create'])->name('details.create');
Route::post('details/store', [DetailsController::class, 'store'])->name('details.store');
Route::get('/details', [DetailsController::class, 'index'])->name('details.index');
Route::get('/users/{id}/details/edit',[DetailsController::class,'edit']);
Route::put('/users/{id}/details/update',[DetailsController::class,'update']);
Route::get('/users/{userId}/details/user', [DetailsController::class, 'show'])->name('details.show');
Route::delete('/details/{id}', [DetailsController::class, 'destroy'])->name('details.destroy');

Route::get('/users/{id}/details/pay', [DetailsController::class, 'pay'])->name('details.pay');
Route::post('/users/{id}/details/pay', [DetailsController::class, 'reduce'])->name('details.reduce');
