@extends('layouts.app')


@section('title')
ログイン画面
@endsection

@include('layouts/nav')



@section('content')
<div class="container">
    <div class="card border-light" style="width: 500px">
        <div class="card-body">
            <div class="font-weight-bold text-center border-bottom pb-3" style="font-size: 24px">ログイン</div>

            <form method="POST" action="{{ route('login') }}" class="pt-5 pr-5 pb-3 pl-5">
                @csrf


                <div class="form-group">
                    <label for="email">メールアドレス</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="メールアドレスを入力">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">パスワード</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="パスワードを入力">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>


                <div class="form-group mt-5">
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
@endsection
