@csrf

<div class="input-tags">
    <recipe-tags
        :initial-tags='@json($tagNames ?? [])'
        :autocomplete-items='@json($allTagNames ?? [])'
    >
    </recipe-tags>
</div>

{{-- 料理画像 --}}
<div class="cooking-image-form">
    <label for="cooking_img_file">料理画像</label>
    <input type="file" name="cooking_img_file" class="d-none" accept="image/png,image/jpeg,image/gif" id="cooking_img_file" />
    <label for="cooking_img_file" class="image" role="button">
        <img src="/images/default-recipe-image.png" style="object-fit: cover; width: 300px; height: 200px;">
    </label>
</div>

{{-- 料理名 --}}
<div class="cook-title form-group">
    <label for="title">料理名</label>
    <input id="title" type="text" class="cook-title form-control" name="title" value="{{ $recipe->title ?? old('title') }}" required autocomplete="title" autofocus>
</div>


<div class="form-md-area">
    {{-- 調理時間 --}}
    <div class="cook-time form-group">
        <label for="cook_time">調理時間（分）</label>
          <input id="cook_time" type="text" class="md-area form-control" name="cook_time" value="{{ $recipe->cook_time ?? old('cook_time') }}" required autocomplete="cook_time">
    </div>
    
    
    {{-- 料理の種類 --}}
    <div class="meal-type form-group">
        <label for="meal_type_id">料理の種類</label>
        <select name="meal_type_id" class="md-area form-control">
            @foreach($meal_types as $meal_type)
                <option value="{{ $meal_type->id }}" {{ old('meal_type', $recipe->meal_type_id ?? '') == $meal_type->id ? 'selected' : '' }}>
                    {{ $meal_type->name }}
                </option>
            @endforeach
        </select>
    </div>
    
    
    {{-- 料理の区分 --}}
    <div class="meal-class form-group">
        <label for="meal_class_id">料理の区分</label>
        <select name="meal_class_id" class="md-area form-control">
            @foreach($meal_classes as $meal_class)
                <option value="{{ $meal_class->id }}" {{ old('meal_class', $recipe->meal_class_id ?? '') == $meal_class->id ? 'selected' : '' }}>
                    {{ $meal_class->name }}
                </option>
            @endforeach
        </select>
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