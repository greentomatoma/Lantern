@extends('layouts.app')


@section('title')
{{ $recipe -> name }}レシピ詳細
@endsection


@include('layouts/nav')


@section('content')
  <div class="recipe-detail shadow-sm">
    <div class="post-user">
      <a href="{{ route('users.show', ['name' => $recipe->user->name]) }}">
        by. 
        @if(!empty($user->avatar_file_name))
          <img src="/storage/avatars/{{ $user->avatar_file_name}}" class="rounded-circle">
        @else
          <img src="/images/avatar-default.svg" class="rounded-circle">
        @endif
        {{ $recipe->user->name}}
      </a>
    </div>
    <div class="recipe-title border-bottom pb-3 pt-3">
     <p class="title">{{ $recipe->title }}</p>
      
      {{-- 保存機能 --}}
      @if(Auth::id() !== $recipe->user_id)
      <div class="recipe-stock">
        <p class="stock">保存する</p>
        <recipe-stock
          :initial-is-stocked-by = '@json($recipe->isStockedBy(Auth::user()))'
          :initial-count-stocks = '@json($recipe->count_stocks)'
          :authorized = '@json(Auth::check())'
          endpoint = "{{ route('recipes.stock', ['recipe' => $recipe]) }}"
        >
        </recipe-stock>
      </div>
      @endif
    </div>


      
    <div class="recipe-detail-top">
      <div class="recipe-image">
        @if(!empty($recipe->cooking_img_file))
          <img src="/storage/recipes/{{ $recipe->cooking_img_file }}" class="card-img-top">
        @else
          <img src="/images/default-recipe-image.png" class="card-img-top">
        @endif
      </div>
      <div class="top-right">
        <div class="top-right-category">
          <ul>
            <li class="meal-type">
              <div class="meal-type-icon" style="background-color: grey; width: 64px; height: 64px; "></div>
              <span class="for-people">{{ $recipe->mealType->name }}</span>
            </li>
            <li class="cook-time">
              <div class="cook-time-icon" style="background-color: grey; width: 64px; height: 64px; "></div>
              <span class="time">{{ $recipe->cook_time }}分</span>
            </li>
            <li class="meal-class">
              <div class="meal-class-icon" style="background-color: grey; width: 64px; height: 64px; "></div>
              <span class="category">{{ $recipe->mealClass->name }}</span>
            </li>
          </ul>
        </div>
        <div class="ingredients-list">
            <p class="item-title ingredients"><span>■ </span>材料</p>
            <div class="ingredients-text">{!! nl2br(e($recipe->ingredients)) !!}</div>
        </div>
      </div>
    </div>
  
      <div class="description-list">
        <p class="item-title description"><span>■ </span>作り方</p>
        <div class="description-text">{!! nl2br(e($recipe->description)) !!}</div>
      </div>

    <div class="comment">
        <p class="item-title"><span>■ </span>コメント</p>
        <div class="comment-text">
          @if(!empty($recipe->comment))
            {!! nl2br(e($recipe->comment)) !!}
          @else
            {{ $recipe->user->name }}さんからのコメントはありません。
          @endif
        </div>
    </div>
  </div>

  <div class="top-page-button">
    <a class="top-button" href="{{ route('recipes.index') }}">
      トップページへ
    </a>
  </div>
@endsection