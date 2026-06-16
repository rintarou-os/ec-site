<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    //お問合せフォーム表示
    public function create()
    {
        return view('contact.create');
    }

    //お問い合わせ送信
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);
        Contact::createContact($validatedData);

        return redirect()->route('product.index');

    }

}
