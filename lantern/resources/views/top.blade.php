@extends('layouts/app')

@include('layouts/nav')

<div id="container">
  <div id="content">
    <main>
        <div class="screen">
          <div class="screen__content h1">
            <span class="screen-title">アイデアを</span>
            <span class="orange">共有</span>
            <span class="screen-title">しよう</span>
          </div>
          <div class="screen__main">
            <img class="main-image" src="/images/top_page/top_image.png">
            <div class="main-lantern">
              <img src="/images/top_page/top_page_lantern.png">
            </div>
          </div>
        </div>
    </main>
  </div>

  <main>
    <section>
      <div class="concept">
        <h2 class="concept__title">コンセプト</h2>
        <div class="line"></div>
        <p class="concept__text">
          Lanternのコンセプトは、「<span class="orange">アイデアの共有</span>」です。
          <br>
          ランタンは、小さな灯りですがみんなで共有することができます。
          <br>
        </p>
        <p class="concept__text">
          災害時、何をどうしたら良いのかわからない...
          <br>
          そんな状況の中でもみんなの灯りとなれるような場を作りたいという思いから
          <br>
          Lanternが生まれました。
        </p>
      </div>
    </section>

    <section>
      <div class="about">
          <h2 class="about__title">できること</h2>
          <div class="about__items">
            <div class="about__item">
              <p class="item-title"><span class="number">01</span>閲覧</p>
              <img src="/images/top_page/top_look.png">
              <p class="item-text">みんなのアイデアがいつでも見れる</p>
            </div>
            <div class="about__item">
            <p class="item-title"><span class="number">02</span>投稿</p>
              <img class="share" src="/images/top_page/top_share.png">
              <p class="item-text">アイデアを投稿しみんなで共有</p>
            </div>
            <div class="about__item">
            <p class="item-title"><span class="number">03</span>保存</p>
              <img src="/images/top_page/top_stock.png">
              <p class="item-text">お気に入りのアイデアを保存できる</p>
            </div>
          </div>
      </div>
    </section>
  </main>
</div>