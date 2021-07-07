@extends('layouts/app')

@section('title', 'レシピ一覧')

@include('layouts/nav')

@section('content')

<div class="recipe-container">
  <div class="recipe">
    <div class="recipe-cards row">
      @foreach($recipes as $recipe)
        <div class="recipe-card shadow-sm-4 col-md-3 col-sm-6 col-xs-12">
          <div class="card-top">
            <div class="recipe-post-user">
              <a href="{{ route('users.show', ['name' => $recipe->user->name]) }}">
                @if(!empty($user->avatar_file_name))
                  <img src="/storage/avatars/{{ $user->avatar_file_name}}" class="rounded-circle">
                @else
                  <img src="/images/avatar-default.svg" class="rounded-circle">
                @endif
                {{ $recipe->user->name}}
              </a>
            </div>

            {{-- 保存機能 --}}
              @if(Auth::id() !== $recipe->user_id)
              <div class="recipe-stock mb-1">
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

          <div class="bd-placeholder-img card-img-top">
            <a href="{{ route('recipes.show', ['recipe' => $recipe]) }}">
              @if(!empty($recipe->cooking_img_file))
                <img class="card-img-top" src="/storage/recipes/{{ $recipe->cooking_img_file }}">
              @else
                <img class="card-img-top" src="/images/default-recipe-image.png">
              @endif
            </a>
          </div>

          <div class="card-body">
            <a href="{{ route('recipes.show', ['recipe' => $recipe]) }}">
                <h1 class="recipe-title">{{ $recipe->title }}</h1>
            </a>

            <div class="card-body-md">
                <div class="body-md meal-type">
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
                  <p class="meal-type">{{ $recipe->mealType->name }}</p>
                </div>
                <div class="body-md cook-time ">
                  <img class="cook-time-icon" src="../images/icons/time.svg" alt="調理時間アイコン">
                  <p class="cook-time">{{ $recipe->cook_time }}分</p>
                </div>
                <div class="body-md meal-class ">
                  <div class="meal-class-icon"></div>
                  <p class="meal-class">{{ $recipe->mealClass->name }}</p>
                </div>
            </div>

            <div class="card-tags">
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
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>

@endsection