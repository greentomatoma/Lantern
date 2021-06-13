@extends('layouts.app')


@section('title')
{{ $recipe -> name }}レシピ詳細
@endsection


@include('layouts/nav')


@section('content')
  <div class="container">
    <div class="font-weight-bold text-center border-bottom pb-3 pt-3" style="font-size: 24px">{{ $recipe->title }}</div>
      
    <div class="row mt-5">
      <div class="col-4 offset-1">
        @if(!empty($recipe->cooking_img_file))
          <img src="/storage/recipes/{{ $recipe->cooking_img_file }}" class="card-img-top">
        @else
          <img src="/images/default-recipe-image.png" class="card-img-top">
        @endif
      </div>
      <div class="col-6">
        <table class="table table-bordered">
          <tr>
            <th>調理時間</th>
            <td>{{ $recipe->cook_time }}分</td>
          </tr>
        </table>
      </div>
  
      <div>
        <div><材料></div>
        <div>{!! nl2br(e($recipe->ingredients)) !!}</div>
  
        <div><作り方></div>
        <div>{!! nl2br(e($recipe->description)) !!}</div>
  
        <div><コメント></div>
        @if(!empty($recipe->comment))
          <div>{!! nl2br(e($recipe->comment)) !!}</div>
        @else
          <div>{{ $recipe->user->name }}さんからのコメントはありません。</div>
        @endif
      </div>

    </div>
      


  </div>

@endsection