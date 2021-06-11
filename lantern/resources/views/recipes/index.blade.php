@extends('layouts/app')

@section('title', 'レシピ一覧')

@include('layouts/nav')

@section('content')

<div class="container">
  <div class="row">
    <div class="card mr-5" style="width: 18rem;">
      <img src="..." class="card-img-top" alt="img">
      <div class="card-body">
        <h5 class="card-title">タイトル</h5>
        <p class="card-text">料理説明</p>
        <a href="#" class="btn btn-primary">レシピをみる</a>
      </div>
    </div>
    <div class="card" style="width: 18rem;">
      <img src="..." class="card-img-top" alt="img">
      <div class="card-body">
        <h5 class="card-title">タイトル</h5>
        <p class="card-text">料理説明</p>
        <a href="#" class="btn btn-primary">レシピをみる</a>
      </div>
    </div>
  </div>

</div>

@endsection