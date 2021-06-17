import './bootstrap'
import Vue from 'vue'
import RecipeStock from './components/RecipeStock'


const app = new Vue({
  el: '#app',
  components: {
    RecipeStock,
  }
})


document.addEventListener('DOMContentLoaded', function() {

  const inputGet = document.querySelector('.image-picker input');

  if(!inputGet) { return false; }

  inputGet.addEventListener('change', (e) => {
    const input = e.target;
    const reader = new FileReader();
    reader.onload = (e) => {
      // 画像読み込み後の処理
      input.closest('.image-picker').querySelector('img').src = e.target.result
    };
    reader.readAsDataURL(input.files[0]);
  });
});
