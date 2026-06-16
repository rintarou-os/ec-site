<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    // アカウント編集フォーム表示
    public function edit()
    {
        $user = Auth::user();
        return view('account.edit', compact('user'));
    }

    // アカウント更新処理
    public function update(Request $request)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'name_kanji' => 'required|string|max:255',
            'name_kana' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->updateAccount($validatedData);

        return redirect()->route('mypage.index');
    }
}