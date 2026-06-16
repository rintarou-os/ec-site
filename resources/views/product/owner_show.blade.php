@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            @if ($product->img_path)
                <img src="{{ asset('storage/' . $product->img_path) }}" class="img-fluid" alt="{{ $product->product_name }}">
            @endif
        </div>
        <div class="col-md-6">
            <h2>{{ $product->product_name }}</h2>
            <p>{{ $product->description }}</p>
            <p class="fs-4">¥{{ number_format($product->price) }}</p>

            <a href="{{ route('product.edit', $product->id) }}" class="btn btn-primary">編集</a>

            <form action="{{ route('product.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('本当に削除しますか？');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">削除する</button>
            </form>

            <a href="{{ route('mypage.index') }}" class="btn btn-secondary">戻る</a>
        </div>
    </div>
</div>
@endsection