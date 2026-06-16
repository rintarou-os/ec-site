<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Like extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }


    //お気に入り追加、削除
    public static function toggleLike(int $productId)
    {
        $like = self::where('user_id',Auth::id())
                    ->where('product_id',$productId)
                    ->first();
        if($like){
            $like->delete();
            return false;
        }else{
            self::create([
                'user_id' => Auth::id(),
                'product_id' => $productId,
            ]);
            return true;
        }
    }

    //おきに状態確認
    public static function isLiked(int $productId)
    {
        return self::where('user_id', Auth::id())
                    ->where('product_id',$productId)
                    ->exists();
    }
}
