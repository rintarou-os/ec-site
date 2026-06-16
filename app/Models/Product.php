<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Product extends Model
{
    protected $fillable = [
        'user_id',
        'company_id',
        'product_name',
        'price',
        'stock',
        'description',
        'img_path',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }


    //商品一覧取得
    public static function getAllProducts()
    {
        return self::where('stock','>',0)->latest()->get();
    }

    public static function updateProduct(Product $product, array $validatedData, $imgPath)
        {
        $product->update([
        'product_name' => $validatedData['product_name'],
        'price' => $validatedData['price'],
        'stock' => $validatedData['stock'],
        'description' => $validatedData['description'],
        'img_path' => $imgPath ?? $product->img_path,
        ]);
    }

    //ユーザの出品商品一覧
    public static function getProductsByUser($userId)
    {
        return self::where('user_id',$userId)->latest()->get();
    }

    //商品新規登録
    public static function createProduct(array $validatedData,$imgPath)
    {
        return self::create([
            'user_id' => Auth::id(),
            'company_id' => Auth::user()->company_id,
            'product_name' => $validatedData['product_name'],
            'price' => $validatedData['price'],
            'stock' => $validatedData['stock'],
            'description' => $validatedData['description'],
            'img_path' => $imgPath,
        ]);
    }

    //商品削除
    public static function deleteProduct(Product $product)
    {
        $product->delete();
    }

    // 商品検索
    public static function searchProducts(Request $request)
    {
     $query = self::where('stock', '>', 0);

        if ($request->filled('product_name')) {
            $query->where('product_name', 'like', '%' . $request->product_name . '%');
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
         $query->where('price', '<=', $request->max_price);
        }

        return $query->latest()->get();
    }
}