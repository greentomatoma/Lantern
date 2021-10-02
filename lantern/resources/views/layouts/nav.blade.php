<header id="container">
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
                            <div class="nav-icon">
                            <img class="icon-before" src="/images/header/about_before.svg"
                                onmouseover="this.src='/images/header/about_after.svg'"
                                onmouseout="this.src='/images/header/about_before.svg'">
                            </div>
                            <p>Lanternについて</p>
                          </a>
                      </li>
                      <li class="nav-list-item">
                          <a class="navbar-about" href="#">
                            <div class="nav-icon">
                            <img class="icon-before" src="/images/header/pot_before.svg"
                                onmouseover="this.src='/images/header/pot_after.svg'"
                                onmouseout="this.src='/images/header/pot_before.svg'">
                            </div>
                            <p>使い方</p>
                          </a>
                      </li>
                      <li class="nav-list-item">
                          <a class="navbar-about" href="{{url('/about_pack')}}">
                          <div class="nav-icon">
                            <img class="icon-before" src="/images/header/pot_before.svg"
                                onmouseover="this.src='/images/header/pot_after.svg'"
                                onmouseout="this.src='/images/header/pot_before.svg'">
                            </div>
                            <p>災害時での調理</p>
                          </a>
                      </li>
                      <li class="nav-list-item">
                          <a class="navbar-about" href="{{ route('recipes.index') }}">
                            <div class="nav-icon">
                            <img class="icon-before" src="/images/header/recipe_before.svg"
                                onmouseover="this.src='/images/header/recipe_after.svg'"
                                onmouseout="this.src='/images/header/recipe_before.svg'">
                            </div>
                            <p>レシピをみる / 書く</p>
                          </a>
                      </li>
                  </ul>
              </div>

              <div class="mobile-btn">
                  <button class="mobile-menu__btn">
                    <span></span>
                    <span></span>
                    <span></span>
                  </button>
                  <span class="mobile-menu__text">
                    MENU
                  </span>
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
    <div class="mobile-menu">
        <ul class="mobile-menu__list">
            <li class="mobile-menu__item">
                <a class="mobile-menu__link" href="{{url('/')}}">
                    Lanternについて
                </a>
            </li>
            <li class="mobile-menu__item">
                <a class="mobile-menu__link" href="#">
                    使い方
                </a>
            </li>
            <li class="mobile-menu__item">
                <a class="mobile-menu__link" href="{{url('/about_pack')}}">
                    災害時での調理
                </a>
            </li>
            <li class="mobile-menu__item">
                <a class="mobile-menu__link" href="{{ route('recipes.index') }}">
                    レシピをみる / 書く
                </a>
            </li>
        </ul>
    </div>
</header>