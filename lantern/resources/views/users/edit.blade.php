@extends('layouts/app')

@section('title', 'プロフィール編集')

@include('layouts/nav')

@section('content')

<div class="container">
<div>
  @if(session('status'))
    <div class="alert alert-success" role="alert">
      {{ session('status') }}
    </div>
  @endif
</div>

  <form method="POST" action="{{ route('users.update', ['user' => $user]) }}" enctype="multipart/form-data">
      @csrf
      <div class="profile">
  
          {{-- アバター画像 --}}
            <div class="form-image image-picker">
              <input type="file" name="avatar_img_file" class="d-none" accept="image/png,image/jpeg,image/gif" id="avatar" />
              <label for="avatar" class="avatar_image">
                @if (!empty($user->avatar_img_file))
                  <img src="/storage/avatars/{{$user->avatar_img_file}}" class="rounded-circle">
                @else
                  <img src="/images/avatar-default.svg" class="rounded-circle">
                @endif
              </label>
            </div>
      
          {{-- ニックネーム --}}
          <div class="nickname form-group">
              <label for="name">ニックネーム</label>
              <input id="name" type="text" class="nickname form-control" name="name" value="{{ $user->name ?? old('name') }}" required autocomplete="name">
          </div>
  
  
        <div class="edit-button">
          <button type="submit" class="btn mt-2">
            プロフィールを変更
          </button>
        </div>

      </div>
  
  </form>

</div>

@endsection
