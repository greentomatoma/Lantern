@extends('layouts.app')


@section('title')
レシピ投稿画面
@endsection

@include('layouts/nav')

@section('content')
<div class="container">
    <div class="card border-light" style="width: 700px">
        <div class="font-weight-bold text-center border-bottom pb-3 pt-3" style="font-size: 24px">レシピ投稿</div>
          <form method="POST" action="{{ route('register') }}" class="pt-5 pr-5 pb-3 pl-5">
              @csrf

              {{-- 料理画像 --}}
              <div>料理画像</div>
              <div style="background-color: gray; width: 300px; height: 100px">img</div>
              
              {{-- 料理名 --}}
              <div class="title form-group mt-5">
                  <label for="title">料理名</label>
                  <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus placeholder="料理名">
                  @error('title')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>


              {{-- 調理時間 --}}
              <div class="cook_time form-group">
                  <label for="cook_time">調理時間</label>
                  <div class="d-flex">
                    <input id="cook_time" type="text" class="form-control @error('cook_time') is-invalid @enderror" name="cook_time" value="{{ old('cook_time') }}" required autocomplete="cook_time">
                    <label class="minute">分</label>
                  </div>
                  @error('cook_time')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>


              {{-- 材料 --}}
              <div class="ingredients form-group">
                  <label for="ingredients">材料</label>
                  <textarea id="ingredients" type="text" class="form-control @error('ingredients') is-invalid @enderror" name="ingredients" required ></textarea>
                  @error('ingredients')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>


              {{-- 作り方 --}}
              <div class="description form-group">
                  <label for="description">作り方</label>
                  <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" required ></textarea>
                  @error('description')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>


              {{-- コメント --}}
              <div class="comment form-group">
                  <label for="comment">コメント</label>
                  <textarea id="comment" type="text" class="form-control @error('comment') is-invalid @enderror" name="comment"></textarea>
              </div>


              <div class="form-group mt-5">
                  <button type="submit" class="btn btn-block btn-warning p-2">
                      投稿
                  </button>
              </div>
          </form>
    </div>
</div>
@endsection
