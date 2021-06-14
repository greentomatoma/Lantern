@extends('layouts/app')

@section('title', 'レシピ一覧')

@include('layouts/nav')

@section('content')

<div class="container">
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mt-5">
    @foreach($recipes as $recipe)
      <div class="col mb-3">
        <div class="card shadow-sm">
          <a href="{{ route('recipes.show', ['recipe' => $recipe]) }}">
            @if(!empty($recipe->cooking_img_file))
              <img src="/storage/recipes/{{ $recipe->cooking_img_file }}" class="card-img-top" style="object-fit: cover;">
            @else
              <img src="/images/default-recipe-image.png" class="card-img-top" style="object-fit: cover; width: 100%; height: 100%;">
            @endif
          </a>

          <div class="card-body">
            <h5 class="card-title">{{ $recipe->title }}</h5>
            <div class="d-flex justify-content-between aline-items-center">
              <a href="{{ route('recipes.show', ['recipe' => $recipe]) }}" class="btn btn-warning">レシピをみる</a>

              {{-- 編集・削除 --}}
              @if(Auth::id() === $recipe->user_id )
              <div class="d-flex aline-items-center">
                <a href="{{ route('recipes.edit', ['recipe' => $recipe]) }}" class="btn btn-warning mr-1">
                  <i class="fas fa-pen mt-1"></i>
                </a>
                <a class="btn btn-warning" data-toggle="modal" data-target="#modal-delete-{{ $recipe->id }}">
                  <i class="fas fa-trash-alt mt-1"></i>
                </a>
              </div>

              <!-- modal -->
              <div id="modal-delete-{{ $recipe->id }}" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form method="POST" action="{{ route('recipes.destroy', ['recipe' => $recipe]) }}">
                      @csrf
                      @method('DELETE')
                      <div class="modal-body">
                        「{{ $recipe->title}}」を削除します。削除されたレシピは元に戻すことはできません。
                      </div>
                      <div class="modal-footer justify-content-between">
                        <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
                        <button type="submit" class="btn btn-danger">削除する</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- modal -->
              @endif
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>

@endsection