@extends('layouts/app')

@section('title', $user->name . 'のノート')

@include('layouts/nav')

@section('content')
<div class="container mt-4">

  {{-- ストックレシピ一覧 --}}
  <div class="all-post-lists">
    <div class="note-header">
      <h2 class="list-title"><i class="fas fa-bookmark title"></i>ストックレシピ一覧</h2>
        <div class="search_note">

        </div>
    </div>

    @if(!empty($recipes))

      @foreach($recipes as $recipe)
          @include('users/card')  
      @endforeach

    @else
      ストックしているレシピはありません。
    @endif
  </div>
</div>

@endsection