<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Sale;

class MypageController extends Controller
{
    //マイページ表示
    public function index()
    {
        $user = Auth::user();
        $products = Product::getProductsByUser($user->id);
        $sales = Sale::getSalesByUser($user->id);

        return view('mypage.index',compact('user','products','sales'));

    }
}
