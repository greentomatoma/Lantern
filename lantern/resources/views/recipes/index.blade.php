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
            <div class="bd-placeholder-img card-img-top" style="width: 100%; height: 225px; object-fit: cover;">
              @if(!empty($recipe->cooking_img_file))
                <img src="/storage/recipes/{{ $recipe->cooking_img_file }}" class="card-img-top" style="object-fit: cover; width: 100%; height: 100%;">
              @else
                <img src="/images/default-recipe-image.png" class="card-img-top" style="object-fit: cover; width: 100%; height: 100%;">
              @endif
            </div>
          </a>

          <div class="card-body">
            <h5 class="card-title">{{ $recipe->title }}</h5>

            @foreach($recipe->tags as $tag)
              @if($loop->first)
              <div class="card-body pt-0 pl-3">
                <div class="card-text line-height">
              @endif
                <a href="{{ route('tags.show', ['name' => $tag->name]) }}" class="text-muted">
                  {{ $tag->hashtag }}
                </a>
              @if($loop->last)
                </div>
              </div>
              @endif
            @endforeach
            <div class="d-flex justify-content-between">
              <a href="{{ route('recipes.show', ['recipe' => $recipe]) }}" class="btn btn-warning mt-2">レシピをみる</a>

              {{-- 保存機能 --}}
              @if(Auth::id() !== $recipe->user_id)
              <recipe-stock
                :initial-is-stocked-by = '@json($recipe->isStockedBy(Auth::user()))'
                :initial-count-stocks = '@json($recipe->count_stocks)'
                :authorized = '@json(Auth::check())'
                endpoint = "{{ route('recipes.stock', ['recipe' => $recipe]) }}"
              >
              </recipe-stock>
              @endif

              {{-- 編集・削除 --}}
              @if(Auth::id() === $recipe->user_id)
              <div class="d-flex aline-items-center mt-2">
                <a class="btn mr-1" href="{{ route('recipes.edit', ['recipe' => $recipe]) }}">
                  <i class="fas fa-pen mt-1 fa-lg"></i>
                </a>
                <a class="btn mr-1" data-toggle="modal" data-target="#modal-delete-{{ $recipe->id }}">
                  <i class="fas fa-trash-alt mt-1 fa-lg"></i>
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