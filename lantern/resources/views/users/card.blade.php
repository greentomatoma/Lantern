{{-- 投稿レシピ１件分 --}}
<div class="post-recipe-card">
    <div class="card-top">
        <p class="post-time">
          <a href="{{ route('users.show', ['name' => $recipe->user->name] )}}">
          @if(!empty($user->avatar_file_name))
            <img src="/storage/avatars/{{ $user->avatar_file_name}}" class="rounded-circle">
          @else
            <img src="/images/avatar-default.svg" class="rounded-circle">
          @endif
          {{ $recipe->user->name}}さん
          </a> 
          が{{ $recipe->created_at->format('Y年m月d日') }}に投稿
        </p>

        {{-- 編集・削除 --}}
        @if(Auth::id() === $recipe->user_id)
        <div class="edit-and-delete">
          <a class="edit-btn" href="{{ route('recipes.edit', ['recipe' => $recipe]) }}">
            <i class="fas fa-pen mt-1 fa-lg"></i>
          </a>
          <a class="delete-btn" data-toggle="modal" data-target="#modal-delete-{{ $recipe->id }}">
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
        @else
        <div class="recipe-stock mb-1">
          <recipe-stock
            :initial-is-stocked-by = '@json($recipe->isStockedBy(Auth::user()))'
            :initial-count-stocks = '@json($recipe->count_stocks)'
            :authorized = '@json(Auth::check())'
            endpoint = "{{ route('recipes.stock', ['recipe' => $recipe]) }}"
          >
          </recipe-stock>
        </div>
        @endif
        {{-- //編集・削除 --}}
    </div>

    <div class="card-main">
        <a href="{{ route('recipes.show', ['recipe' => $recipe]) }}">
            <div class="post-recipe-img">
                @if(!empty($recipe->cooking_img_file))
                  <img src="/storage/recipes/{{ $recipe->cooking_img_file }}" class="card-img-top">
                @else
                  <img src="/images/default-recipe-image.png" class="card-img-top">
                @endif
            </div>
        </a>
        <div class="card-main-text">
          <h3 class="card-title">
              <a href="{{ route('recipes.show', ['recipe' => $recipe]) }}">{{ $recipe->title }}</a>
          </h3>
          <div class="recipe-features">
              <div class="body-md meal-type ">
                <div class="meal-type-icon"></div>
                <p class="meal-type">{{ $recipe->mealType->name }}</p>
              </div>
              <div class="body-md cook-time ">
                <div class="cook-time-icon"></div>
                <p class="cook-time">{{ $recipe->cook_time }}分</p>
              </div>
              <div class="body-md meal-class ">
                <div class="meal-class-icon"></div>
                <p class="meal-class">{{ $recipe->mealClass->name }}</p>
              </div>
          </div>
        </div>
    </div>

    <div class="card-bottom">
        {{-- タグ --}}
        @foreach($recipe->tags as $tag)
          @if($loop->first)
          <div class="tag">
            <div class="card-text line-height">
          @endif
            <a class="text-muted" href="{{ route('tags.show', ['name' => $tag->name]) }}">
              {{ $tag->hashtag }}
            </a>
          @if($loop->last)
            </div>
          </div>
          @endif
        @endforeach
        {{-- //タグ --}}
    </div>
</div>
