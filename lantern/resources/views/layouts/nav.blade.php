<nav class="navbar navbar-expand navbar-light">
  <div class="nav-container">
      <a class="navbar-brand" href="{{ url('/') }}">
          {{ config('app.name', 'Laravel') }}
      </a>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('recipes.create') }}" >
                    <i class="fas fa-edit"></i>
                    <div class="nav-text">レシピを書く</div>
                </a>
            </li>
              @guest
                  {{-- 非ログイン --}}
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('login') }}">
                          <i class="fas fa-sign-in-alt"></i>
                          <div>ログイン</div>
                      </a>
                  </li>
              @else
                  {{-- ログイン済み --}}
                  <li class="nav-item dropdown">
                      <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        @if (!empty(Auth::user()->avatar_img_file))
                          <img src="{{ Storage::disk('s3')->url('avatars/{Auth::user()->avatar_img_file}') }}" class="rounded-circle">
                        @else
                          <img src="/images/avatar-default.svg" class="rounded-circle">
                        @endif
                      </a>

                      {{-- ドロップダウンメニュー --}}
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="{{ route('users.show', ['name' => Auth::user()->name]) }}" >
                              マイページ
                          </a>
                          <a class="dropdown-item" href="{{ route('users.note', ['name' => Auth::user()->name]) }}" >
                              マイノート
                          </a>
                          <a class="dropdown-item" href="{{ route('logout') }}"
                              onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                              ログアウト
                          </a>
                          <form id="logout-form" action="{{ route('logout')}}" method="POST" style="display: none;">
                             @csrf
                          </form>
                      </div>
                  </li>
              @endguest
          </ul>
      </div>
  </div>
</nav>

{{-- 検索窓 --}}
<div class="search">
    <form class="search-form" method="GET" action="{{ route('search.index')}}">
        <span class="fas fa-search"></span>
        <input class="input-form" type="search" name="keyword" placeholder="食材名・料理名・調理時間 など" />
    </form>
</div>