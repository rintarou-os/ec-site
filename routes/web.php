<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\LikeController;

Auth::routes();

// 商品一覧（トップページ）
Route::get('/', [ProductController::class, 'index'])->name('product.index');

// 商品検索、（非同期）
Route::get('/products/search', [ProductController::class, 'search'])->name('product.search');

// お問い合わせ
Route::get('/contacts/create', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contacts', [ContactController::class, 'store'])->name('contact.store');

// 要ログイン
Route::middleware('auth')->group(function () {
    // 商品新規登録
    Route::get('/products/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/products', [ProductController::class, 'store'])->name('product.store');

    // 商品編集
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('product.update');

    // 商品削除
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('product.destroy');

    // 購入
    Route::get('/purchases/{product}', [PurchaseController::class, 'create'])->name('purchase.create');
    Route::post('/purchases', [PurchaseController::class, 'store'])->name('purchase.store');

    // マイページ
    Route::get('/mypage', [MypageController::class, 'index'])->name('mypage.index');

    // アカウント編集
    Route::get('/account/edit', [AccountController::class, 'edit'])->name('account.edit');
    Route::put('/account', [AccountController::class, 'update'])->name('account.update');

    // 商品出品詳細
    Route::get('/mypage/products/{product}', [ProductController::class, 'ownerShow'])->name('product.ownerShow');

    // お気に入り
    Route::post('/likes/{product}', [LikeController::class, 'toggle'])->name('like.toggle');

});

// 商品詳細
Route::get('/products/{product}', [ProductController::class, 'show'])->name('product.show');

// API（購入）
Route::post('/api/purchases', [PurchaseController::class, 'apiStore'])->name('api.purchases.store');