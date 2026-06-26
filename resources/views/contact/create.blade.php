@extends('layouts.app')

@section('content')
<div class="container">
    <h2>お問い合わせ</h2>

    <form action="{{ route('contact.store') }}" method="POST">
        @csrf

        <div calss="mb-3">
            <label class="form-label">名前</label>
            <p>{{ $user->name }}</p>
        </div>

       <div class="mb-3">
        <label class="form-label">メールアドレス</label>
        <P>{{ $user->email }}</p>
       </div>

       <input type="hidden" name="name" vlaue="{{ $user->name }}">
       <input type="hidden" name="email" value="{{ $user->email }}">


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