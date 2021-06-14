@csrf

{{-- 料理画像 --}}
<div>料理画像</div>
<span class="cooking-image-form image-picker">
    <input type="file" name="cooking_img_file" class="d-none" accept="image/png,image/jpeg,image/gif" id="cooking_img_file" />
    <label for="cooking_img_file" class="d-inline-block" role="button">
        <img src="/images/default-recipe-image.png" style="object-fit: cover; width: 300px; height: 200px;">
    </label>
</span>

{{-- 料理名 --}}
<div class="title form-group mt-5">
    <label for="title">料理名</label>
    <input id="title" type="text" class="form-control" name="title" value="{{ $recipe->title ?? old('title') }}" required autocomplete="title" autofocus placeholder="料理名">
</div>


{{-- 調理時間 --}}
<div class="cook_time form-group">
    <label for="cook_time">調理時間</label>
    <div class="d-flex">
      <input id="cook_time" type="text" class="form-control" name="cook_time" value="{{ $recipe->cook_time ?? old('cook_time') }}" required autocomplete="cook_time">
      <label class="minute">分</label>
    </div>
</div>


{{-- 材料 --}}
<div class="ingredients form-group">
    <label for="ingredients">材料</label>
    <textarea id="ingredients" type="text" class="form-control" name="ingredients" required >{{ $recipe->ingredients ?? old('ingredients') }}</textarea>
</div>


{{-- 作り方 --}}
<div class="description form-group">
    <label for="description">作り方</label>
    <textarea id="description" type="text" class="form-control" name="description"  required >{{ $recipe->description ?? old('description') }}</textarea>
</div>


{{-- コメント --}}
<div class="comment form-group">
    <label for="comment">コメント</label>
    <textarea id="comment" type="text" class="form-control" name="comment" >{{ $recipe->comment ?? old('comment') }}</textarea>
</div>