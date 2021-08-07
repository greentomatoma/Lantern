{{-- 検索・タグ検索の画面で使用 --}}
{{-- レシピ１件分 --}}

<div class="post-recipe-card">
    <div class="card-top">
        <p class="post-time">
          <a href="{{ route('users.show', ['name' => $recipe->user->name] )}}">
          @if (!empty($recipe->user->avatar_img_file))
            <img src="{{ Storage::disk('s3')->url("avatars/{$recipe->user->avatar_img_file}") }}" class="rounded-circle">
          @else
            <img src="/images/avatar-default.svg" class="rounded-circle">
          @endif
          {{ $recipe->user->name}}さん
          </a> 
          が{{ $recipe->created_at->format('Y年m月d日') }}に投稿
        </p>
    </div>

    <div class="card-main">
        <a href="{{ route('recipes.show', ['recipe' => $recipe]) }}">
            <div class="post-recipe-img">
                @if(!empty($recipe->cooking_img_file))
                  <img src="{{ Storage::disk('s3')->url("recipes/{$recipe->cooking_img_file}") }}" class="card-img-top">
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
              <div class="body-md meal-type">
                    @if($recipe->mealType->id == 1)
                      <img class="meal-type-icon" src="/images/icons/staple_food.svg" alt="主食アイコン">
                    @elseif($recipe->mealType->id == 2)
                      <img class="meal-type-icon" src="/images/icons/main_dish.svg" alt="主菜アイコン">
                    @elseif($recipe->mealType->id == 3)
                      <img class="meal-type-icon" src="/images/icons/side_dish.svg" alt="副菜アイコン">
                    @elseif($recipe->mealType->id == 4)
                      <img class="meal-type-icon" src="/images/icons/soup.svg" alt="汁物アイコン">
                    @elseif($recipe->mealType->id == 5)
                      <img class="meal-type-icon" src="/images/icons/dessert.svg" alt="デザートアイコン">
                    @else
                      <img class="meal-type-icon" src="/images/icons/other_dishes.svg" alt="その他アイコン">
                    @endif
                  <p class="meal-type">{{ $recipe->mealType->name }}</p>
              </div>
              <div class="body-md cook-time ">
                <img class="cook-time-icon" src="/images/icons/time.svg" alt="調理時間アイコン">
                <p class="cook-time">{{ $recipe->cook_time }}分</p>
              </div>
              <div class="body-md meal-class ">
                    @if($recipe->mealClass->id == 1)
                      <img class="meal-class-icon" src="/images/icons/class_gray.svg" alt="指定なし">
                    @elseif($recipe->mealClass->id == 2)
                      <img class="meal-class-icon" src="/images/icons/class_purple.svg" alt="容易にかめる">
                    @elseif($recipe->mealClass->id == 3)
                      <img class="meal-class-icon" src="/images/icons/class_pink.svg" alt="歯ぐきでつぶせる">
                    @elseif($recipe->mealClass->id == 4)
                      <img class="meal-class-icon" src="/images/icons/class_orange.svg" alt="舌でつぶせる">
                    @else($recipe->mealClass->id == 5)
                      <img class="meal-class-icon" src="/images/icons/class_green.svg" alt="かまなくてよい">
                    @endif
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

