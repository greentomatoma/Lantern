@extends('layouts.app')


@section('title')
{{ $recipe -> name }}レシピ詳細
@endsection


@include('layouts/nav')


@section('content')
  <div class="main-recipe shadow-sm">
    <div class="recipe-title font-weight-bold text-center border-bottom pb-3 pt-3">{{ $recipe->title }}</div>
      
    <div class="top">
      <div class="recipe-image">
        @if(!empty($recipe->cooking_img_file))
          <img src="/storage/recipes/{{ $recipe->cooking_img_file }}" class="card-img-top">
        @else
          <img src="/images/default-recipe-image.png" class="card-img-top">
        @endif
      </div>
      <div class="top-right mt-5">
        <div class="top-right-category">
          <ul>
            <li class="li-people">
              <div class="icon" style="background-color: grey; width: 64px; height: 64px; "></div>
              <span class="for-people">２人分</span>
            </li>
            <li class="li-genre">
              <div class="icon" style="background-color: grey; width: 64px; height: 64px; "></div>
              <span class="genre">ジャンル</span>
            </li>
            <li class="li-category">
              <div class="icon" style="background-color: grey; width: 64px; height: 64px; "></div>
              <span class="category">カテゴリ</span>
            </li>
            <li class="li-time">
              <div class="icon" style="background-color: grey; width: 64px; height: 64px; "></div>
              <span class="time">{{ $recipe->cook_time }}分</span>
            </li>
          </ul>
        </div>
        <div class="ingredients-list">
            <span class="ingredients-title">材料</span>
            <div>{!! nl2br(e($recipe->ingredients)) !!}</div>
        </div>
      </div>
    </div>
  
      <div class="mt-5">
        <div class="d-flex justify-content">
          <div class="ingredients-list" style="background-color: gray; width: 60%; height: 50vh;">
            <div class="description-title" style="font-size: 18px">作り方</div>
            <div>{!! nl2br(e($recipe->description)) !!}</div>
          </div>
        </div>

        <div class="ingredients-list mt-5" style="background-color: gray; width: 50%; height: 30vh;">
          <div class="comment-title" style="font-size: 18px">コメント</div>
          @if(!empty($recipe->comment))
            <div>{!! nl2br(e($recipe->comment)) !!}</div>
          @else
            <div>{{ $recipe->user->name }}さんからのコメントはありません。</div>
          @endif
        </div>
      </div>


      


  </div>

@endsection