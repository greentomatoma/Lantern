@extends('layouts/app')

@section('title', 'レシピ一覧')

@include('layouts/nav')

@section('content')

<div class="container">
  <div class="row">
    @foreach($recipes as $recipe)
      <div class="card mr-5" style="width: 18rem;">
        <img src="..." class="card-img-top" alt="img">
        <div class="card-body">
          <h5 class="card-title">{{ $recipe->title }}</h5>
          <a href="#" class="btn btn-warning">レシピをみる</a>
        </div>
      </div>
    @endforeach
  </div>
</div>

@endsection