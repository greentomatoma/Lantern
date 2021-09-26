@extends('layouts/app')

@section('title', $user->name . 'のノート')

@section('content')
@include('layouts/search_box')
<div id="app" class="container mt-4">

  
  <div class="all-post-lists">
    <div class="note-header">
      <h2 class="list-title"><i class="fas fa-bookmark title"></i>ストックレシピ一覧</h2>

      <async-search
      :stock-recipes = '@json($recipes)'
      :url = '@json($url)'
      :s3-avatar = '@json($s3_avatar)'
      :s3-recipe = '@json($s3_recipe)'
      >
      </async-search>

    </div>

  </div>
  
</div>

@endsection