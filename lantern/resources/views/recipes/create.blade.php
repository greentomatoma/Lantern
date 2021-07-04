@extends('layouts.app')


@section('title')
レシピ投稿画面
@endsection

@include('layouts/nav')

@section('content')
<div class="container">
    <div class="card border-light">
          <h1 class="post-recipe">レシピ投稿</h1>

            @include('layouts/error_card_list')

            <form method="POST" action="{{ route('recipes.store') }}" class="post-recipe-form" enctype="multipart/form-data">

                @include('recipes/form')

                <div class="post-button">
                    <button type="submit" class="btn p-2">
                        投稿
                    </button>
                </div>
                
            </form>
    </div>
</div>
@endsection
