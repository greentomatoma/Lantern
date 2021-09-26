@extends('layouts.app')

@section('title')
ログイン画面
@endsection

@section('content')
<div class="container">
    <div class="card border-light">
        <div class="card-body border-light">
            <div class="card-title">ログイン</div>

            @include('layouts/error_card_list')

            <div class="form-area">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <label class="form-label" for="email">メールアドレス</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="メールアドレスを入力">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password">パスワード</label>
                        <input id="password" type="password" class="form-control validate-target" name="password" required minlength="8" placeholder="パスワードを入力">
                        <div class="invalid-feedback"></div>
                    </div>


                    <div class="form-btn mt-5">
                        <button type="submit" class="btn btn-block btn-warning">
                            ログイン
                        </button>
                    </div>

                    <div class="form-text mt-5">
                        アカウントをお持ちでない方は<a href="{{ route('register') }}">こちら</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
