@extends('layouts.app')


@section('title')
レシピ投稿画面
@endsection

@include('layouts/nav')

@section('content')
<div class="container d-flex justify-content-center mt-3">
    <div class="card border-light" style="width: 700px">
        <div class="row">
        </div>
          <div class="font-weight-bold text-center border-bottom pb-3 pt-3" style="font-size: 24px">レシピ投稿</div>

            @include('layouts/error_card_list')

            <form method="POST" action="{{ route('recipes.store') }}" class="pt-5 pr-5 pb-3 pl-5" enctype="multipart/form-data">

                @include('recipes/form')

                <div class="form-group mt-5">
                    <button type="submit" class="btn btn-block btn-warning p-2">
                        投稿
                    </button>
                </div>
                
            </form>
    </div>
</div>
@endsection
