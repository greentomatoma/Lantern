import './bootstrap'
import Vue from 'vue'
import RecipeStock from './components/RecipeStock'
import RecipeTags from './components/RecipeTags'
import AsyncSearch from './components/AsyncSearch'


new Vue({
  el: '#app',
  components: {
    RecipeStock,
    RecipeTags,
    AsyncSearch,
  }
})


document.addEventListener('DOMContentLoaded', function() {

  const inputGet = document.querySelector('.form-image input');

  if(!inputGet) { return false; }

  inputGet.addEventListener('change', (e) => {
    const input = e.target;
    const reader = new FileReader();
    reader.onload = (e) => {
      // 画像読み込み後の処理
      input.closest('.form-image').querySelector('img').src = e.target.result
    };
    reader.readAsDataURL(input.files[0]);
  });
});
