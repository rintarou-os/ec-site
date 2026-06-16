<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Product;

class PurchaseController extends Controller
{
    // 購入確認画面n
    public function create(Product $product)
    {
        return view('purchase.create', compact('product'));
    }

    // 購入処理
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($validatedData['product_id']);

        Sale::createSale($product, $validatedData['quantity']);

        return redirect()->route('product.index');
    }

    // 購入処理（API）
    public function apiStore(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($validatedData['product_id']);

        Sale::createSale($product, $validatedData['quantity']);

        return response()->json([
            'message' => '購入が完了しました',
            'product_id' => $product->id,
        ]);
    }
}