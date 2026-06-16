@extends('layouts.app')

@section('content')
<div class="container">
    <h2>お問い合わせ</h2>

    <form action="{{ route('contact.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">名前</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">メールアドレス</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="message" class="form-label">お問い合わせ内容</label>
            <textarea name="message" id="message" class="form-control">{{ old('message') }}</textarea>
            @error('message')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <a href="{{ route('product.index') }}" class="btn btn-secondary">戻る</a>
        <button type="submit" class="btn btn-primary">送信</button>
    </form>
</div>
@endsection