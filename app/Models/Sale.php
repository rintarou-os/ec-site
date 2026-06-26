<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Sale extends Model
{
    protected $fillable =[
        'user_id',
        'product_id',
        'quantity',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    //購入処理
    public static function createSale(Product $product, int $quantity, $userId = null)
    {
        //在庫チェック
        if ($product->stock <= 0){
            throw new \Exception('この商品は在庫がありません。');
        }

        if (quantity > $product->stock){
            throw new \Exception('在庫数を超えた数は購入できません。');
        }

        self::create([
            'user_id' => $userId ?? Auth::id(),
            'product_id' => $product->id,
            'quantity' => $quantity,
        ]);

        $product->update(['stock' => $product->stock - $quantity]);
    }
    
    //ユーザの購入履歴所得
    public static function getSalesByUser($userId)
    {
        return self::where('user_id', $userId)->with('product')->orderBy('created_at','asc')->get();
    }
}
