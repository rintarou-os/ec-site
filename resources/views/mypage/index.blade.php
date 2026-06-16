@extends('layouts.app')

@section('content')
<div class="container">
    <h2>マイページ</h2>

    <div class="mb-4">
        <p>ユーザ名：{{ $user->name }}</p>
        <p>Eメール：{{ $user->email }}</p>
        <p>名前：{{ $user->name_kanji }}</p>
        <p>カナ：{{ $user->name_kana }}</p>
        <a href="{{ route('account.edit') }}" class="btn btn-outline-secondary">アカウント編集</a>
        <a href="{{ route('product.create') }}" class="btn btn-primary">新規登録</a>
    </div>

    <h4>出品した商品</h4>
    <div class="row mb-4">
        @foreach ($products as $product)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->product_name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text">¥{{ number_format($product->price) }}</p>
                        <a href="{{ route('product.ownerShow', $product->id) }}" class="btn btn-outline-primary">詳細</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <h4>購入した商品</h4>
    <div class="row">
        @foreach ($sales as $sale)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $sale->product->product_name }}</h5>
                        <p class="card-text">{{ $sale->product->description }}</p>
                        <p class="card-text">¥{{ number_format($sale->product->price) }}</p>
                        <p class="card-text">個数：{{ $sale->quantity }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection