@extends('layouts/app')

@include('layouts/nav')

<div id="main" class="top-container">
  <div class="t-wrapper">
    <img class="t-main-top-img" src="/images/top_page/top_image.png">
    <div class="h1 t-main-contents">
      <span class="t-main-title">
        アイデアを
        <span class="t-main-title-orange">共有</span>しよう
      </span>
      <span class="t-main-top-img-lantern">
        <img src="/images/top_page/top_page_lantern.png">
      </span>
    </div>
  </div>

  <div class="t-main-content">
    <div class="t-main-concept">
      <h2 id="item1" class="concept-title">コンセプト</h2>
      <div class="title-line"></div>
      <p class="concept-text">
        Lanternのコンセプトは、「<span class="text1-orange">アイデアの共有</span>」です。
        <br>
        ランタンは、小さな灯りですがみんなで共有することができます。
        <br>
      </p>
      <p class="concept-text">
        災害時、何をどうしたら良いのかわからない...
        <br>
        そんな状況の中でもみんなの灯りとなれるような場を作りたいという思いから
        <br>
        Lanternが生まれました。
      </p>
    </div>
    <div class="t-main-about">
      <h2 class="about-title"><span id="item2" class="t-main-about-text">Lantern</span>でできること</h2>
      <div class="t-items">
        <div class="t-item box-1">
          <p class="t-item-name"><span class="number">01</span>閲覧</p>
          <img src="/images/top_page/top_look.png">
          <p class="t-item-text">みんなのアイデアがいつでも見れる</p>
        </div>
        <div class="t-item box-2">
        <p class="t-item-name"><span class="number">02</span>投稿</p>
          <img class="img2" src="/images/top_page/top_share.png">
          <p class="t-item-text">アイデアを投稿しみんなで共有</p>
        </div>
        <div class="t-item box-3">
        <p class="t-item-name"><span class="number">03</span>保存</p>
          <img src="/images/top_page/top_stock.png">
          <p class="t-item-text">お気に入りのアイデアを保存できる</p>
        </div>
      </div>
    </div>
  </div>

</div>