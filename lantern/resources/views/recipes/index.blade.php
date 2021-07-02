@extends('layouts/app')

@section('title', 'レシピ一覧')

@include('layouts/nav')

@section('content')


{{-- 検索窓 --}}
<!-- <div class="search">
  <form class="form-inline" method="GET" action="{{ route('search.index')}}">
    <input class="form-control pl-4" type="search" name="keyword" placeholder="キーワード検索" />
    <button type="submit" class="btn btn-outline-dark">
      <i class="fas fa-search"></i>
    </button>
  </form>
</div> -->

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
                <div class="body-md meal-type ">
                  <div class="meal-type-icon"></div>
                  <p class="meal-type" style="font-size: 12px;">{{ $recipe->mealType->name }}</p>
                </div>
                <div class="body-md cook-time ">
                  <div class="cook-time-icon"></div>
                  <p class="cook-time" style="font-size: 12px;">{{ $recipe->cook_time }}分</p>
                </div>
                <div class="body-md meal-class ">
                  <div class="meal-class-icon"></div>
                  <p class="meal-class" style="font-size: 12px;">{{ $recipe->mealClass->name }}</p>
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