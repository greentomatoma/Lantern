@extends('layouts/app')

@section('title', $tag->hashtag)

@include('layouts/nav')

@section('content')
<div class="container mt-4">

  {{-- レシピ一覧 --}}
  <div class="all-post-lists">

    <div class="hashtag-list d-flex" style="flex-direction: column;">
      <h2 class="list-title">{{ $tag->hashtag }}</h2>
      <div class="list-title">
        <p>検索結果： <span class="count">{{ $tag->recipes->count() }}</span> <span class="items">品</span></p>
      </div>
    </div>

    @foreach($tag->recipes as $recipe)
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
                    <div class="body-md meal-type">
                          @if($recipe->mealType->id == 1)
                            <img class="meal-type-icon" src="/images/icons/staple_food.svg" alt="主食アイコン">
                          @elseif($recipe->mealType->id == 2)
                            <img class="meal-type-icon" src="/images/icons/main_dish.svg" alt="主菜アイコン">
                          @elseif($recipe->mealType->id == 3)
                            <img class="meal-type-icon" src="/images/icons/side_dish.svg" alt="副菜アイコン">
                          @elseif($recipe->mealType->id == 4)
                            <img class="meal-type-icon" src="/images/icons/soup.svg" alt="汁物アイコン">
                          @elseif($recipe->mealType->id == 5)
                            <img class="meal-type-icon" src="/images/icons/dessert.svg" alt="デザートアイコン">
                          @else
                            <img class="meal-type-icon" src="/images/icons/other_dished.svg" alt="その他アイコン">
                          @endif
                        <p class="meal-type">{{ $recipe->mealType->name }}</p>
                    </div>
                    <div class="body-md cook-time ">
                      <img class="cook-time-icon" src="/images/icons/time.svg" alt="調理時間アイコン">
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

  </div>
</div>

@endsection