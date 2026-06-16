@extends('layouts.app')

@section('content')
<div class="container">
    <h2>商品一覧</h2>

    <form id="search-form" class="row mb-4">
        <div class="col-md-4">
            <input type="text" name="product_name" id="product_name" class="form-control" placeholder="商品名">
        </div>
        <div class="col-md-3">
            <input type="number" name="min_price" id="min_price" class="form-control" placeholder="最低価格">
        </div>
        <div class="col-md-3">
            <input type="number" name="max_price" id="max_price" class="form-control" placeholder="最高価格">
        </div>
        <div class="col-md-2">
            <button type="button" id="search-btn" class="btn btn-primary w-100">検索</button>
        </div>
    </form>

    <div id="product-list" class="row">
        @foreach ($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card">
                    @if ($product->img_path)
                        <img src="{{ asset('storage/' . $product->img_path) }}" class="card-img-top" alt="{{ $product->product_name }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->product_name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text">¥{{ number_format($product->price) }}</p>
                        <a href="{{ route('product.show', $product->id) }}" class="btn btn-outline-primary">詳細</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@push('scripts')
    <script src="{{ asset('js/product.js') }}"></script>
@endpush

@endsection