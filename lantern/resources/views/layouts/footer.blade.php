<footer>
  <div class="footer">
    <div class="footer__container">
      <div class="footer__logo">
          Lantern
      </div>
      <ul class="footer__menu">
        <li><a class="rink" href="{{ url('/') }}">このアプリについて</a></li>
        <li><a class="rink" href="{{ url('/about_pack') }}">災害時の調理について</a></li>
        <li><a class="rink" href="{{ route('recipes.index') }}">レシピ一覧</a></li>
      </ul>
    </div>
    <p class="footer__copyright">
      © 2021 Lantern.
    </p>
  </div>
</footer>