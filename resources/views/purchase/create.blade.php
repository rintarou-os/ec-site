@extends('layouts.app')

@section('content')
<div class="container">
    <h2>購入画面</h2>

    <div class="row">
        <div class="col-md-6">
            @if ($product->img_path)
                <img src="{{ asset('storage/' . $product->img_path) }}" class="img-fluid" alt="{{ $product->product_name }}">
            @endif
        </div>
        <div class="col-md-6">
            <h4>{{ $product->product_name }}</h4>
            <p>{{ $product->description }}</p>
            <p>¥{{ number_format($product->price) }}</p>
            <p>残り：{{ $product->stock }}個</p>
            <p>会社：{{ $product->company->company_name }}</p>

            <form id="purchase-form" action="{{ route('purchase.store') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <div class="mb-3">
                    <label for="quantity" class="form-label">数量</label>
                    <input type="number" name="quantity" id="quantity" class="form-control" min="1" max="{{ $product->stock }}" value="1">
                </div>

                <a href="{{ route('product.show', $product->id) }}" class="btn btn-secondary">戻る</a>
                <button type="button" id="open-confirm-modal" class="btn btn-primary">購入する</button>
            </form>
        </div>
    </div>
</div>

<!-- 購入確認モーダル -->
<div class="modal" id="confirm-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">購入確認</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                この内容で購入してよろしいですか？
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">キャンセル</button>
                <button type="button" id="confirm-purchase-btn" class="btn btn-primary">確定する</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('js/purchase.js') }}"></script>
@endpush

@endsection