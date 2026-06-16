<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;

class LikeController extends Controller
{
    //お気に入りトグル
    public function toggle(Request $request, $product)
    {
        $isLiked = Like::toggleLike($product);

        return response()->json([
            'liked' => $isLiked,
        ]);
    }
}
