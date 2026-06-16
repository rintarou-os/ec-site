<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'name',
        'email',
        'message',
    ];

    //お問い合わせ保存
    public static function createContact(array $validatedData)
    {
        return self::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'message' => $validatedData['message'],
        ]);
    }

}
