@extends('layouts/app')

@include('layouts/nav')

<div id="main">
  <div class="top-container">
    <div class="top">
      <h1 class="top-title">災害時の調理について</h1>
      <p class="top-text">
        災害時には、ライフラインの寸断、家屋の倒壊・損傷などで自宅で食事を摂ることができなくなります。
        <br>
        また、避難所では支援物資の飲食が続くことで野菜不足、塩分過剰摂取、栄養の偏りなどの問題が生じています。
        <br>
        さらに、乳幼児や高齢者、アレルギーをお持ちの方、食事療養が必要な方たちは的確な食事を摂取する必要があります。
        <br>
        このように調理を行うのに十分な環境が整わない中で、個別に対応ができる調理法として「パッククッキング」があります。
      </p>
    </div>
    <div class="main">
      <div class="m-about-pack">
        <div class="m-about-pack-text">
          <h2 class="main-title">パッククッキングとは</h2>
          <p class="main-text">
            ポリ袋（高密度ポリエチレン袋）に、食材と調味料を入れて
            <br>
            沸騰水中に入れるだけ。
            <br>
            個別で調理ができるので、乳幼児や高齢者、アレルギーをお持ちの方、食事療養が必要な方たちのお食事も
            <br>
            同時に作ることができるのが特徴です。
          </p>
        </div>
        <div class="img-about-pack" src="#"></div>
      </div>
      <h2 class="main-title">調理に必要な道具</h2>
      <div class="items">
        <div class="item">
        <div class="img-item">
          <img src="/images/about_cook/gas.png">
        </div>
          <p class="item-title">カセットコンロ</p>
        </div>
        <div class="item">
        <div class="img-item">
        </div>
        <div class="img-item">
          <img src="/images/about_cook/pot.png">
        </div>
          <p class="item-title">鍋（蓋付き）</p>
        </div>
        <div class="item">
        <div class="img-item">
          <img src="/images/about_cook/plate.png">
        </div>
          <p class="item-title">お皿</p>
        </div>
        <div class="item">
        <div class="img-item">
          <img src="/images/about_cook/plastic_bag.png">
        </div>
          <p class="item-title">高密度ポリエチレン袋（ポリ袋）</p>
        </div>
      </div>
      <h2 class="main-title">調理方法</h2>
      <div class="items">
        <div class="item box-1">
          <span class="number">01</span>
          <div class="img-item">
            <img src="/images/about_cook/step_1.png">
          </div>
          <p class="item-text">
            ポリ袋に食材と調味料を入れて、混ぜ合わせる。
            <br>
            袋を結ぶ時はできるだけ空気を抜くようにする。
          </p>
        </div>
        <div class="item box-2">
          <span class="number">02</span>
          <div class="img-item">
            <img src="/images/about_cook/step_2.png">
          </div>
          <p class="item-text">
            鍋に火をかけ、沸騰したらお皿とポリ袋を入れる。
          </p>
        </div>
        <div class="item box-3">
          <span class="number">03</span>
          <div class="img-item-3">
            <img src="/images/about_cook/step_3.png">
          </div>
          <p class="item-text">
            出来上がるまで待つだけ！
            <br>
            ふきこぼれないように注意する。
          </p>
        </div>
      </div>
    </div>
  </div>
</div>