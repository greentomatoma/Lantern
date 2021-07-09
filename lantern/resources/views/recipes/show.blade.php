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
     <div class="title">{{ $recipe->title }}</div>
      
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
              <div class="meal-type-icon">
                  @if($recipe->mealType->id == 1)
                    <img class="meal-type-icon" src="../images/icons/staple_food.svg" alt="主食アイコン">
                  @elseif($recipe->mealType->id == 2)
                    <img class="meal-type-icon" src="../images/icons/main_dish.svg" alt="主菜アイコン">
                  @elseif($recipe->mealType->id == 3)
                    <img class="meal-type-icon" src="../images/icons/side_dish.svg" alt="副菜アイコン">
                  @elseif($recipe->mealType->id == 4)
                    <img class="meal-type-icon" src="../images/icons/soup.svg" alt="汁物アイコン">
                  @elseif($recipe->mealType->id == 5)
                    <img class="meal-type-icon" src="../images/icons/dessert.svg" alt="デザートアイコン">
                  @else
                    <img class="meal-type-icon" src="../images/icons/other_dished.svg" alt="その他アイコン">
                  @endif
              </div>
              <span class="for-people">{{ $recipe->mealType->name }}</span>
            </li>
            <li class="cook-time">
              <div class="cook-time-icon">
                <img class="cook-time-icon" src="../images/icons/time.svg" alt="調理時間アイコン">
              </div>
              <span class="time">{{ $recipe->cook_time }}分</span>
            </li>
            <li class="meal-class">
              <div class="meal-class-icon"></div>
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