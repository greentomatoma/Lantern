@extends('layouts/app')

@section('title', $user->name)

@section('content')
@include('layouts/search_box')
<div class="user-page">
  
  {{-- ユーザー情報 --}}
    <div class="user-detail">
      <div class="user-detail-top">
        {{-- アバター画像 --}}
          <div class="avatar-form image-picker">
            <div class="avatar-image">
              @if (!empty($user->avatar_img_file))
                <img src="{{ Storage::disk('s3')->url("avatars/{$user->avatar_img_file}") }}" class="rounded-circle">
              @else
                <img src="/images/avatar-default.svg" class="rounded-circle">
              @endif
            </div>
          </div>
    
        {{-- ニックネーム --}}
          <div class="user-name">
            {{ $user->name}}
          </div>
      </div>

      @if(Auth::id() === $user->id)
        <div class="edit-profile">
          <a href="{{ route('users.edit', ['name' => Auth::user()->name]) }}" class="edit-button">
            プロフィールを編集する
          </a>
        </div>
      @endif
    </div>

  {{-- 投稿レシピ一覧 --}}
  <div class="all-post-lists">
    <h2 class="list-title"><i class="fas fa-clipboard title"></i>投稿レシピ一覧</h2>

    @foreach($recipes as $recipe)

      @include('partial/card')
      
    @endforeach
  </div>
  
</div>

@endsection