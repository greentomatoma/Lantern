@extends('layouts/app')

@section('title', 'レシピ検索')

@include('layouts/nav')

@section('content')
<div class="container mt-4">

  {{-- 検索結果一覧 --}}
  <div class="all-post-lists">

  <div class="list-title">
    <span>{{ $searchCount }}</span> 品
  </div>

    @if(!empty($recipes))

      @foreach($recipes as $recipe)
      <div class="post-recipe-card">
          <div class="card-top">
              <p class="post-time">
                <a href="{{ route('users.show', ['name' => $recipe->user->name] )}}">
                @if(!empty($user->avatar_file_name))
                  <img src="/storage/avatars/{{ $user->avatar_file_name}}" class="rounded-circle">
                @else
                  <img src="/images/avatar-default.svg" class="rounded-circle">
                @endif
                {{ $recipe->user->name}}さん
                </a> 
                が{{ $recipe->created_at->format('Y年m月d日') }}に投稿
              </p>
          </div>

          <div class="card-main">
              <a href="{{ route('recipes.show', ['recipe' => $recipe]) }}">
                  <div class="post-recipe-img">
                      @if(!empty($recipe->cooking_img_file))
                        <img src="/storage/recipes/{{ $recipe->cooking_img_file }}" class="card-img-top">
                      @else
                        <img src="/images/default-recipe-image.png" class="card-img-top">
                      @endif
                  </div>
              </a>
              <div class="card-main-text">
                <h3 class="card-title">
                    <a href="{{ route('recipes.show', ['recipe' => $recipe]) }}">{{ $recipe->title }}</a>
                </h3>
                <div class="recipe-features">
                    <div class="body-md meal-type ">
                      <div class="meal-type-icon"></div>
                      <p class="meal-type">{{ $recipe->mealType->name }}</p>
                    </div>
                    <div class="body-md cook-time ">
                      <div class="cook-time-icon"></div>
                      <p class="cook-time">{{ $recipe->cook_time }}分</p>
                    </div>
                    <div class="body-md meal-class ">
                      <div class="meal-class-icon"></div>
                      <p class="meal-class">{{ $recipe->mealClass->name }}</p>
                    </div>
                </div>
              </div>
          </div>

          <div class="card-bottom">
              {{-- タグ --}}
              @foreach($recipe->tags as $tag)
                @if($loop->first)
                <div class="tag">
                  <div class="card-text line-height">
                @endif
                  <a class="text-muted" href="{{ route('tags.show', ['name' => $tag->name]) }}">
                    {{ $tag->hashtag }}
                  </a>
                @if($loop->last)
                  </div>
                </div>
                @endif
              @endforeach
              {{-- //タグ --}}
          </div>
      </div>
      @endforeach
      
    @else
      該当するレシピはありませんでした。
    @endif

</div>

@endsection