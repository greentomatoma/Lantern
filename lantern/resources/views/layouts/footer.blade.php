<footer class="footer">
  <div class="footer-container">
    <div class="logo">
        Lantern
    </div>
    <ul class="nav-menu">
      <li><a href="{{ url('/') }}">このアプリについて</a></li>
      <li><a href="{{ url('/about_pack') }}">災害時の調理について</a></li>
      <li><a href="{{ route('recipes.index') }}">レシピ一覧</a></li>
    </ul>
  </div>
  <p class="copyright">
    © 2021 Lantern.
  </p>
</footer>