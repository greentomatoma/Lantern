@extends('layouts/app')

@section('title', 'レシピ一覧')

@include('layouts/nav')
@include('layouts/search_box')

@section('content')

<div class="recipe-container">
  <div class="recipes">
    <div class="recipe-cards row">
      @foreach($recipes as $recipe)
        <div class="recipe-card shadow-sm-4 col-md-3 col-sm-6 col-xs-12">
          <div class="card-top">
            <div class="recipe-post-user">
              <a href="{{ route('users.show', ['name' => $recipe->user->name]) }}">
                @if (!empty($recipe->user->avatar_img_file))
                  <img src="{{ Storage::disk('s3')->url("avatars/{$recipe->user->avatar_img_file}") }}" class="rounded-circle">
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
            {{-- //保存機能 --}}
            
          </div>

          <div class="card-img-top">
            <a href="{{ route('recipes.show', ['recipe' => $recipe]) }}">
              @if(!empty($recipe->cooking_img_file))
                <img class="card-img-top" src="{{ Storage::disk('s3')->url("recipes/{$recipe->cooking_img_file}") }}">
              @else
                <img class="card-img-top" src="/images/default-recipe-image.png">
              @endif
            </a>
          </div>

          <div class="card-body">
            <h1 class="recipe-title">
                <a href="{{ route('recipes.show', ['recipe' => $recipe]) }}">{{ $recipe->title }}</a>
            </h1>

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
                    <img class="meal-type-icon" src="../images/icons/other_dishes.svg" alt="その他アイコン">
                  @endif
                  <p class="meal-type">{{ $recipe->mealType->name }}</p>
                </div>
                <div class="body-md cook-time ">
                  <img class="cook-time-icon" src="../images/icons/time.svg" alt="調理時間アイコン">
                  <p class="cook-time">{{ $recipe->cook_time }}分</p>
                </div>
                <div class="body-md meal-class ">
                    @if($recipe->mealClass->id == 1)
                      <img class="meal-class-icon" src="/images/icons/class_gray.svg" alt="指定なし">
                    @elseif($recipe->mealClass->id == 2)
                      <img class="meal-class-icon" src="/images/icons/class_purple.svg" alt="容易にかめる">
                    @elseif($recipe->mealClass->id == 3)
                      <img class="meal-class-icon" src="/images/icons/class_pink.svg" alt="歯ぐきでつぶせる">
                    @elseif($recipe->mealClass->id == 4)
                      <img class="meal-class-icon" src="/images/icons/class_orange.svg" alt="舌でつぶせる">
                    @else($recipe->mealClass->id == 5)
                      <img class="meal-class-icon" src="/images/icons/class_green.svg" alt="かまなくてよい">
                    @endif
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