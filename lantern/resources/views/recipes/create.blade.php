@extends('layouts.app')


@section('title')
レシピ投稿画面
@endsection

@include('layouts/nav')

@section('content')
<div class="container">
    <div class="card border-light" style="width: 700px">
        <div class="row">
          <div class="col-8 offset-2">
            @if(session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
          </div>
        </div>
          <div class="font-weight-bold text-center border-bottom pb-3 pt-3" style="font-size: 24px">レシピ投稿</div>

            @include('layouts/error_card_list')

            <form method="POST" action="{{ route('recipes.store') }}" class="pt-5 pr-5 pb-3 pl-5">

                @csrf

                {{-- 料理画像 --}}
                <div>料理画像</div>
                <span class="cooking-image-form image-picker">
                    <input type="file" name="cooking_img_file" class="d-none" accept="image/png,image/jpeg,image/gif" id="cooking_img_file" />
                    <label for="cooking_img_file" class="d-inline-block" role="button">
                        <img src="/images/default-recipe-image.png" style="object-fit: cover; width: 300px; height: 200px;">
                    </label>
                </span>
                
                {{-- 料理名 --}}
                <div class="title form-group mt-5">
                    <label for="title">料理名</label>
                    <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus placeholder="料理名">
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
                      <input id="cook_time" type="text" class="form-control" name="cook_time" value="{{ old('cook_time') }}" required autocomplete="cook_time">
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
                    <textarea id="ingredients" type="text" class="form-control" name="ingredients" required >{{ old('ingredients') }}</textarea>
                </div>


                {{-- 作り方 --}}
                <div class="description form-group">
                    <label for="description">作り方</label>
                    <textarea id="description" type="text" class="form-control" name="description"  required >{{ old('description') }}</textarea>
                </div>


                {{-- コメント --}}
                <div class="comment form-group">
                    <label for="comment">コメント</label>
                    <textarea id="comment" type="text" class="form-control" name="comment" >{{ old('comment') }}</textarea>
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
