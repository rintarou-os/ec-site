<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //商品一覧
    public function index()
    {
        $products = Product::getAllProducts();
        return view('product.index',compact('products'));

    }

    //商品詳細
    public function show(Product $product)
    {
        $isLiked = false;
        if (auth()->check()){
            $isLiked = \App\Models\Like::isLiked($product->id);
        }

        return view('product.show',compact('product','isLiked'));
    }


    //商品新規登録フォーム
    public function create()
    {
        return view('product.create');
    }


    //商品新規登録処理
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'img_path' => 'required|image|max:2048',
        ]);

        $imgPath = null;
        if ($request->hasFile('img_path')){
            $imgPath = $request->file('img_path')->store('products','public');
        }

        Product::createProduct($validatedData,$imgPath);

        return redirect()->route('mypage.index');
    }


    //商品編集フォーム
    public function edit(Product $product)
    {
        return view('product.edit',compact('product'));
    }


    //商品編集処理
    public function update(Request $request,Product $product)
    {
        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'img_path' => 'nullable|image|max:2048',
        ]);

        $imgPath = null;
        if ($request->hasFile('img_path')){
            $imgPath = $request->file('img_path')->store('products','public');
        }

        Product::updateProduct($product,$validatedData,$imgPath);

        return redirect()->route('mypage.index');
    }



    //商品削除処理
    public function destroy(Product $product)
    {
        Product::deleteProduct($product);
        return redirect()->route('mypage.index');
    }

    // 出品商品詳細
    public function ownerShow(Product $product)
    {
        return view('product.owner_show', compact('product'));
    }

    //商品検索(複数から)
    public function search(Request $request)
    {
        $products = Product::searchProducts($request);

        return response()->json($products);
    }
}