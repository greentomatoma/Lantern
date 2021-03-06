@extends('layouts/app')

@section('title', 'レシピ検索結果')

@section('content')
@include('layouts/search_box')
<div class="container mt-4">

  {{-- 検索結果一覧 --}}
  <div class="all-post-lists">
    <div class="list-title">
      <p>検索結果： <span class="count">{{ $searchCount }}</span> <span class="list-title-items">品</span></p>
    </div>

    @if(!empty($recipes))

      @foreach($recipes as $recipe)

        @include('partial/card_2')

      @endforeach
      
    @else
      該当するレシピはありませんでした。
    @endif
  </div>
</div>

@endsection