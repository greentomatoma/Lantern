<template>
  <div>
    <input type="text" class="search_note" v-model="keyword" placeholder="ノート内を検索">
      <div class="post-recipe-card" v-for="recipe in filterRecipes" :key="recipe.id">
        <header class="card-top">
          <p class="post-time">
            <a href="#">
              <img src="/images/avatar-default.svg" class="rounded-circle">
            {{ recipe.user_id }}さん
            </a> 
            が{{ recipe.created_at }}に投稿
          </p>
        </header>
        <main class="card-main">
          <a href="#">
              <div class="post-recipe-img">
                    <img src="/images/default-recipe-image.png" class="card-img-top">
              </div>
          </a>
          <div class="card-main-text">
            <h3 class="card-title">
                <a href="#">{{ recipe.title }}</a>
            </h3>
            <div class="recipe-features">
              <div class="body-md meal-type">
                <p class="meal-type">料理の種類</p>
              </div>
              <div class="body-md cook-time ">
                <img class="cook-time-icon" src="/images/icons/time.svg" alt="調理時間アイコン">
                <p class="cook-time">{{ recipe.cook_time }}分</p>
              </div>
              <div class="body-md meal-class ">
                <div class="meal-class-icon"></div>
                <p class="meal-class">料理のクラス</p>
              </div>
            </div>
          </div>
        </main>
        <div class="card-bottom">
          #タグ
        </div>
      </div>
  </div>
</template>


<script>
export default {
  props: {
    initialStockRecipes: {
      type: Array,
      default: [],
    },
    user: {

    },
  },
  data() {
    return {
      keyword: '',
      stockRecipes: this.initialStockRecipes,
      userNmae: this.userNmae,
    }
  },
  computed: {
    filterRecipes() {
      let filtered = [];
      for (let i in this.stockRecipes) {
          let recipe = this.stockRecipes[i];
          if (recipe.title.indexOf(this.keyword) !== -1) {
              filtered.push(recipe);
          }
        }
      return filtered;
    },
  }
}
</script>

<style scoped>


</style>