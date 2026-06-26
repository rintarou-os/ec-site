<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    //お問合せフォーム表示
    public function create()
    {
        $user = Auth::user();
        return view('contact.create',compact('user'));
    }

    //お問い合わせ送信
    public function store(ContactRequest $request)
    {
        $validatedData = $request->validated();
        Contact::createContact($validatedData);

        return redirect()->route('product.index');

    }

}
