@extends('layouts.app')

@section('title')
レシピ編集
@endsection


@section('content')
<div class="container">
    <div class="card border-light">
          <h1 class="card-title">{{ $recipe->title }}</h1>

            @include('layouts/error_card_list')

            <form class="recipe-form" method="POST" action="{{ route('recipes.update', ['recipe' => $recipe]) }}" enctype="multipart/form-data">
            @method('PATCH')

                @include('recipes/form')

                <div class="edit-button">
                    <button type="submit" class="btn p-2">
                        変更する
                    </button>
                </div>

            </form>
    </div>
</div>
@endsection
