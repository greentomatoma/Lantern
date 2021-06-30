@extends('layouts.app')


@section('title')
ログイン画面
@endsection

@include('layouts/nav')



@section('content')
<div class="container d-flex justify-content-center mt-3">
    <div class="card border-light">
        <div class="card-body">
            <div class="card-title border-bottom">ログイン</div>

            @include('layouts/error_card_list')

            <div class="form-area">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email">メールアドレス</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="メールアドレスを入力">
                    </div>

                    <div class="form-group">
                        <label for="password">パスワード</label>
                        <input id="password" type="password" class="form-control" name="password" required placeholder="パスワードを入力">
                    </div>


                    <div class="form-btn mt-5">
                        <button type="submit" class="btn btn-block btn-warning">
                            ログイン
                        </button>
                    </div>

                    <div class="text-center mt-5">
                        アカウントをお持ちでない方は<a href="{{ route('register') }}">こちら</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
