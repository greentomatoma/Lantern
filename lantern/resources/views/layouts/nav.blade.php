<nav class="navbar navbar-expand navbar-light">
  <div class="nav-container">
      <div class="navbar-brand">
          <a class="app-logo" href="{{ route('recipes.index') }}">
              Lantern
          </a>
      </div>
      <div class="nav-main-content">
          <div class="nav-top">
              <ul class="nav-top-menu">
                  @guest
                      {{-- 非ログイン --}}
                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('login') }}">
                              <i class="fas fa-sign-in-alt"></i>
                              <div>ログイン</div>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('register') }}">
                              <i class="fas fa-user-plus"></i>
                              <div>新規登録</div>
                          </a>
                      </li>
                  @else
                      {{-- ログイン済み --}}
                      <li class="nav-item dropdown">
                          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                          @if (!empty(Auth::user()->avatar_img_file))
                              <img src="{{ Storage::disk('s3')->url('avatars/'. Auth::user()->avatar_img_file) }}" class="rounded-circle">
                          @else
                              <img src="/images/avatar-default.svg" class="rounded-circle">
                          @endif
                          </a>
          
                          {{-- ドロップダウンメニュー --}}
                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="{{ route('recipes.create') }}" >
                                  レシピを書く
                              </a>
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
          <div class="nav-main">
              <ul class="nav-list">
                  <li class="nav-list-item">
                      <a class="navbar-about" href="{{url('/')}}">
                          Lanternについて
                      </a>
                  </li>
                  <li class="nav-list-item">
                      <a class="navbar-about" href="#">
                          使い方
                      </a>
                  </li>
                  <li class="nav-list-item">
                      <a class="navbar-about" href="{{url('/about_pack')}}">
                          災害時での調理
                      </a>
                  </li>
                  <li class="nav-list-item">
                      <a class="navbar-about" href="{{ route('recipes.index') }}">
                          レシピをみる / 書く
                      </a>
                  </li>
              </ul>
          </div>
      </div>

      <!-- <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item"> -->
                <!-- <a class="nav-link" href="{{ route('recipes.create') }}" >
                    <i class="fas fa-edit"></i>
                    <div class="nav-text">レシピを書く</div>
                </a> -->
            <!-- </li>
          </ul>
      </div> -->
  </div>
</nav>