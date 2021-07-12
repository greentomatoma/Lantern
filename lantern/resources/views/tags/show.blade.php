@extends('layouts/app')

@section('title', $tag->hashtag . '検索結果')

@include('layouts/nav')

@section('content')
<div class="container mt-4">

  {{-- タグ検索結果一覧 --}}
  <div class="all-post-lists">

    <div class="hashtag-list d-flex" style="flex-direction: column;">
      <h2 class="list-title">{{ $tag->hashtag }}</h2>
      <div class="list-title">
        <p>検索結果： <span class="count">{{ $tag->recipes->count() }}</span> <span class="items">品</span></p>
      </div>
    </div>

    @foreach($tag->recipes as $recipe)

      @include('partial/card_2')

    @endforeach

  </div>
</div>

@endsection