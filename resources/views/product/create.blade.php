@extends('layouts.app')

@section('content')
<div class="container">
    <h2>商品新規登録</h2>

    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="product_name" class="form-label">商品名</label>
            <input type="text" name="product_name" id="product_name" class="form-control" value="{{ old('product_name') }}">
            @error('product_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">価格</label>
            <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}">
            @error('price')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">商品説明</label>
            <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">在庫数</label>
            <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock') }}">
            @error('stock')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="img_path" class="form-label">商品画像</label>
            <input type="file" name="img_path" id="img_path" class="form-control">
            @error('img_path')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <a href="{{ route('mypage.index') }}" class="btn btn-secondary">戻る</a>
        <button type="submit" class="btn btn-primary">登録</button>
    </form>
</div>
@endsection