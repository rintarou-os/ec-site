@extends('layouts.app')

@section('content')
<div class="container">
    <h2>アカウント編集</h2>

    <form action="{{ route('account.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">ユーザ名</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="name_kanji" class="form-label">名前（漢字）</label>
            <input type="text" name="name_kanji" id="name_kanji" class="form-control" value="{{ old('name_kanji', $user->name_kanji) }}">
            @error('name_kanji')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="name_kana" class="form-label">名前（カナ）</label>
            <input type="text" name="name_kana" id="name_kana" class="form-control" value="{{ old('name_kana', $user->name_kana) }}">
            @error('name_kana')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Eメール</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}">
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <a href="{{ route('mypage.index') }}" class="btn btn-secondary">戻る</a>
        <button type="submit" class="btn btn-primary">更新</button>
    </form>
</div>
@endsection