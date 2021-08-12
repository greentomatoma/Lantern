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
    </div>
    <div class="t-wrapper-right">
      
    </div>
  </div>

  <div class="t-main-content">
    <div class="t-main-about">
      <h2><span class="t-main-about-text">Lantern</span>でできること</h2>
      <div class="t-items">
        <div class="t-item box-1">
          <p class="t-item-name">閲覧</p>
          <img src="/images/top_page/top_look.png">
          <p class="t-item-text">みんなのアイデアがいつでも見れる</p>
        </div>
        <div class="t-item box-2">
        <p class="t-item-name">共有</p>
          <img src="/images/top_page/top_share.png">
          <p class="t-item-text">アイデアを共有</p>
        </div>
        <div class="t-item box-3">
        <p class="t-item-name">保存</p>
          <img src="/images/top_page/top_stock.png">
          <p class="t-item-text">お気に入りの投稿を保存</p>
        </div>
      </div>
    </div>
  </div>

</div>