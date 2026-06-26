<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AccountRequest;

class AccountController extends Controller
{
    // アカウント編集フォーム表示
    public function edit()
    {
        $user = Auth::user();
        return view('account.edit', compact('user'));
    }

    // アカウント更新処理
    public function update(AccountRequest $request)
    {
        $user = Auth::user();

        $validatedData = $request->validated();

        $user->updateAccount($validatedData);

        return redirect()->route('mypage.index');
    }
}