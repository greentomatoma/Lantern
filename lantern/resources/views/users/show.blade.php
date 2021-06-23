@extends('layouts/app')

@section('title', $user->name)

@include('layouts/nav')

@section('content')
<div class="container d-flex mt-4">
  
    <div class="user-detail mr-3" style="width: 360px; height: 590px; background-color: white; padding: 24px;">
      <div class="user-detail-top d-flex" style="flex-direction: column;">
        {{-- アバター画像 --}}
          <div class="avatar-form image-picker justify-content aline-items-center">
            <input type="file" name="avatar" class="d-none" accept="image/png,image/jpeg,image/gif" id="avatar" />
            <label for="avatar" class="d-inline-block">
              @if (!empty($user->avatar_img_file))
                <img src="/storage/avatars/{{$user->avatar_img_file}}" class="rounded-circle" style="object-fit: cover; width: 100px; height: 100px;">
              @else
                <img src="/images/avatar-default.svg" class="rounded-circle" style="object-fit: cover; width: 100px; height: 100px;">
              @endif
            </label>
          </div>
    
        {{-- ニックネーム --}}
          <div class="user-name" style="font-size: 18px;">
            {{ $user->name}}
          </div>
      </div>

      <div class="form-group" style="margin-top: 24px;">
        <a href="{{ route('users.edit', ['name' => Auth::user()->name]) }}" class="btn btn-warning mt-2">
          プロフィールを編集する
        </a>
      </div>
    </div>

  {{-- 投稿レシピ一覧 --}}
  <div class="all-post-lists" style="width: 690px; height: 1000px; background-color: white;">
    <h2 class="list-title" style="font-size: 20px; height: 60px; background-color: white; padding-top: 16px">投稿レシピ一覧</h2>

    @foreach($recipes as $recipe)
      <div class="card" style="height: 220px; background-color: white; padding: 15px;">
        <div class="card-top">
            {{ $recipe->user->name}}さんが{{ $recipe->created_at->format('Y年m月d日') }}に投稿
        </div>
        <div class="card-middle d-flex">
        <a href="{{ route('recipes.show', ['recipe' => $recipe]) }}">
            <div class="card-img" style="width: 240px; height: 150px;">
                @if(!empty($recipe->cooking_img_file))
                  <img src="/storage/recipes/{{ $recipe->cooking_img_file }}" class="card-img-top" style="width: 240px; height: 150px; object-fit: cover;">
                @else
                  <img src="/images/default-recipe-image.png" class="card-img-top" style="width: 240px; height: 150px; object-fit: cover;">
                @endif
            </div>
          </a>
          <h3 class="card-title" style="font-size: 20px;">
            <a href="{{ route('recipes.show', ['recipe' => $recipe]) }}">{{ $recipe->title }}</a>
          </div>
        <div class="card-bottom" style="height: 45px; ">
            タグとブックマーク入る
        </div>
      </div>
    @endforeach
  </div>
</div>

@endsection