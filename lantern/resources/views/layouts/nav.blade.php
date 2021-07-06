<nav class="navbar navbar-expand navbar-light">
  <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}">
          {{ config('app.name', 'Laravel') }}
      </a>

      {{-- 検索窓 --}}
        <div class="search">
            <form class="search-form" method="GET" action="{{ route('search.index')}}">
                <span class="fas fa-search"></span>
                <input class="input-form" type="search" name="keyword" placeholder="食材名・料理名・調理時間 など" />
            </form>
        </div>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto">
              <!-- Authentication Links -->
              @guest
                  {{-- 非ログイン --}}
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('login') }}">ログイン</a>
                  </li>
                  @if (Route::has('register'))
                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('register') }}">新規登録</a>
                      </li>
                  @endif
              @else
                  {{-- ログイン済み --}}
                  <li class="nav-item dropdown">
                      <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                      @if(!empty($user->avatar_file_name))
                        <img src="/storage/avatars/{{ $user->avatar_file_name}}" class="rounded-circle" style="object-fit: cover; width: 35px; height: 35px;">
                      @else
                        <img src="/images/avatar-default.svg" class="rounded-circle" style="object-fit: cover; width: 35px; height: 35px;">
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
                          <a class="dropdown-item" href="{{ route('recipes.create') }}" >
                              レシピを投稿する
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
