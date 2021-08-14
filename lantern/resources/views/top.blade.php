@extends('layouts/app')

<div id="top" class="top-container">
  <div class="t-wrapper">
    <div class="t-wrapper-left">
      <div class="h1 t-main-title">
        アイデアを
        <span class="t-main-title-orange">共有しよう</span>
      </div>
      <a class="t-button-text" href="{{ route('recipes.index') }}">
        <div class="t-button">
          レシピを見る
        </div>
      </a>
      <ul class="t-wrapper-list">
        <li class="t-list-item">
        <a class="t-list" href="#item1">
          コンセプト
          </a>
        </li>
        <li class="t-list-item">
          <a class="t-list" href="#item2">
          Lanternでできること
          </a>
        </li>
      </ul>
    </div>
    <div class="t-wrapper-right">
      
    </div>
  </div>

  <div class="t-main-content">
    <div class="t-main-concept">
      <h2 id="item1" class="concept-title">コンセプト</h2>
      <div class="title-line"></div>
      <p class="concept-text1">
        Lanternのコンセプトは、「<span class="text1-orange">アイデアの共有</span>」です。
        <br>
        ランタンは、小さな灯りですがみんなで共有することができます。
        <br>
      </p>
      <p class="concept-text2">
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
          <p class="t-item-name"><span class="name-1">01</span>閲覧</p>
          <img src="/images/top_page/top_look.png">
          <p class="t-item-text">みんなのアイデアがいつでも見れる</p>
        </div>
        <div class="t-item box-2">
        <p class="t-item-name"><span class="name-2">02</span>投稿</p>
          <img class="img2" src="/images/top_page/top_share.png">
          <p class="t-item-text">アイデアを投稿しみんなで共有</p>
        </div>
        <div class="t-item box-3">
        <p class="t-item-name"><span class="name-3">03</span>保存</p>
          <img src="/images/top_page/top_stock.png">
          <p class="t-item-text">お気に入りのアイデアを保存できる</p>
        </div>
      </div>
    </div>
  </div>

</div>