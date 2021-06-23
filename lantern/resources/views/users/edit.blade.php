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
      <div class="all-post-lists mt-4" style="width: 800px; height: 430px; background-color: white; margin: auto; padding: 24px;">
  
          {{-- アバター画像 --}}
            <div class="avatar-form image-picker text-center">
              <input type="file" name="avatar" class="d-none" accept="image/png,image/jpeg,image/gif" id="avatar" />
              <label for="avatar" class="d-inline-block">
                <img src="/images/avatar-default.svg" class="rounded-circle" style="object-fit: cover; width: 100px; height: 100px;">
              </label>
            </div>
      
          {{-- ニックネーム --}}
          <div class="form-group">
              <label for="name">ニックネーム</label>
              <input id="name" type="text" class="form-control pt-8 pr-16 pb-8 pl-16" name="name" value="{{ $user->name ?? old('name') }}" required autocomplete="name" autofocus placeholder="ニックネームを入力">
          </div>
  
  
        <div class="form-group" style="margin-top: 24px;">
          <button type="submit" class="btn btn-warning mt-2">
            プロフィールを変更
          </button>
        </div>

      </div>
  
  </form>

</div>

@endsection
