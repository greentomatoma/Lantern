@extends('layouts.app')


@section('title')
新規登録
@endsection

@include('layouts/nav')

@section('content')
<div class="container">
    <div class="card border-light">
        <div class="card-body border-light">
            <div class="card-title">新規登録</div>

            @include('layouts/error_card_list')

            <div class="form-area">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group">
                        <label class="form-label" for="name">ニックネーム</label>
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="ニックネームを入力">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="email">メールアドレス</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="メールアドレスを入力">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password">パスワード</label>
                        <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password" placeholder="パスワードを入力">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password_confirmation">パスワード確認</label>
                        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="off">
                    </div>

                    <div class="form-btn mt-5">
                        <button type="submit" class="btn btn-block btn-warning">
                            登録
                        </button>
                    </div>

                    <div class="form-text mt-5">
                        アカウントをお持ちの方は<a href="{{ route('login') }}">こちら</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
