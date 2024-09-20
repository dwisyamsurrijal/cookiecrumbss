<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTransactionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;


Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::get('/details/{product:slug}', [FrontController::class, 'details'])->name('front.product.details');
Route::get('/allproduct', [FrontController::class, 'allproduct'])->name('front.allproduct');
Route::get('/contact', [FrontController::class, 'contact'])->name('front.contact');
Route::get('/search', [FrontController::class, 'search'])->name('front.search');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('role:owner')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('carts', CartController::class)->middleware('role:buyer');
    Route::post('/cart/add/{productId}', [CartController::class, 'store'])->middleware('role:buyer')->name('carts.store');
    Route::get('/carts', [CartController::class, 'index'])->middleware('role:buyer')->name('front.carts');

    Route::get('/product_transactions/search', [ProductTransactionController::class, 'search'])->name('product_transactions.search');

    Route::post('/products/{product}/reviews', [ReviewController::class, 'store'])->name('reviews.store');

    Route::get('/product_transactions/all/pdf', [ProductTransactionController::class, 'generateAllPdf'])->middleware('role:owner')->name('product_transactions.all.pdf');
    Route::get('product_transactions/{productTransaction}/pdf', [ProductTransactionController::class, 'generatePdf'])->name('product_transactions.pdf');

    Route::get('product_transactions/{productTransaction}/upload_proof', [ProductTransactionController::class, 'showUploadProofForm'])->middleware('role:buyer')->name('product_transactions.upload_proof');
    Route::post('product_transactions/{productTransaction}/upload_proof', [ProductTransactionController::class, 'uploadProof'])->middleware('role:buyer')->name('product_transactions.upload_proof.post');
    Route::put('/product_transactions/{productTransaction}/cancel', [ProductTransactionController::class,'cancel'])->middleware('role:owner|buyer')->name('product_transactions.cancel');
    
    Route::resource('product_transactions', ProductTransactionController::class)->middleware('role:owner|buyer');
   

    Route::prefix('admin')->name('admin.')->group(function(){
        
        Route::get('/products/search', [ProductController::class, 'searchproduct'])->middleware('role:owner')->name('products.search');
        Route::resource('products', ProductController::class)->middleware('role:owner');
        
    });
});

require __DIR__.'/auth.php';
