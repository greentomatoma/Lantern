@extends('layouts/app')

@section('title', $user->name . 'のノート')

@include('layouts/nav')

@section('content')
<div id="app" class="container mt-4">

  
  <div class="all-post-lists">
    <div class="note-header">
      <h2 class="list-title"><i class="fas fa-bookmark title"></i>ストックレシピ一覧です</h2>

      <async-search
      :stock-recipes = '@json($recipes)'
      >
      </async-search>

    </div>

  </div>
  
</div>

@endsection