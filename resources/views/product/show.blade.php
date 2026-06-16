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
            <p>会社：{{ $product->company->company_name }}</p>

            @auth
                <button type="button" id="like-btn" data-product-id="{{ $product->id }}"
                        class="btn {{ $isLiked ? 'btn-danger' : 'btn-outline-secondary' }}">
                    お気に入り
                </button>

                <a href="{{ route('purchase.create', $product->id) }}" class="btn btn-primary">カートに追加する</a>
            @endauth

            <a href="{{ route('product.index') }}" class="btn btn-secondary">戻る</a>
        </div>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('js/like.js') }}"></script>
@endpush

@endsection