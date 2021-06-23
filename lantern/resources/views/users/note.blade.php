@extends('layouts/app')

@section('title', $user->name . 'のノート')

@include('layouts/nav')

@section('content')
<div class="container mt-4">

  {{-- ストックレシピ一覧 --}}
  <div class="all-post-lists" style="width: 690px; height: 1000px; background-color: white; margin: auto;">
    <h2 class="list-title" style="font-size: 20px; height: 60px; background-color: white; padding-top: 16px">ストックレシピ一覧</h2>

    @if(!empty($recipes))
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
    @else
      ストックしているレシピはありません。
    @endif
  </div>
</div>

@endsection