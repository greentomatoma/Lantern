<template>
  <div>
    <input type="text" class="search_input" v-model="keyword" placeholder="ノート内を検索">
      <div class="post-recipe-card" v-for="recipe in filterRecipes" :key="recipe.id">
        <header class="card-top">
          <p class="post-time">
            <a :href=" 'http://' + httpHost + '/users/' + `${recipe.user.name}` ">
              <img v-if="recipe.user.avatar_img_file" :src="s3Avatar + `${recipe.user.avatar_img_file}`" class="rounded-circle">
              <img v-else src="/images/avatar-default.svg" class="rounded-circle">
            {{ recipe.user.name }}さん
            </a> 
            が{{ recipe.created_at | createdDate }}に投稿しました。
          </p>

        </header>
        <main class="card-main">
          <a :href=" 'http://' + httpHost + '/recipes/' + `${recipe.id}` ">
              <div class="post-recipe-img">
                <img v-if="recipe.cooking_img_file" :src="s3Recipe + `${recipe.cooking_img_file}`">
                <img v-else src="/images/default-recipe-image.png" class="card-img-top">
              </div>
          </a>
          <div class="card-main-text">
            <h3 class="card-title">
                <a :href=" 'http://' + httpHost + '/recipes/' + `${recipe.id}` ">{{ recipe.title }}</a>
            </h3>
            <div class="recipe-features">
              <div class="body-md meal-type">
                <img v-if="recipe.meal_type_id == 1" class="meal-type-icon" src="/images/icons/staple_food.svg" alt="主食アイコン">
                <img v-else-if="recipe.meal_type_id == 2" class="meal-type-icon" src="/images/icons/main_dish.svg" alt="主菜アイコン">
                <img v-else-if="recipe.meal_type_id == 3" class="meal-type-icon" src="/images/icons/side_dish.svg" alt="副菜アイコン">
                <img v-else-if="recipe.meal_type_id == 4" class="meal-type-icon" src="/images/icons/soup.svg" alt="汁物アイコン">
                <img v-else-if="recipe.meal_type_id == 5" class="meal-type-icon" src="/images/icons/dessert.svg" alt="デザートアイコン">
                <img v-else class="meal-type-icon" src="/images/icons/other_dished.svg" alt="その他アイコン">
                <p class="meal-type">{{ recipe.meal_type.name }}</p>
              </div>
              <div class="body-md cook-time ">
                <img class="cook-time-icon" src="/images/icons/time.svg" alt="調理時間アイコン">
                <p class="cook-time">{{ recipe.cook_time }}分</p>
              </div>
              <div class="body-md meal-class ">
                <img v-if="recipe.meal_class_id == 1" class="meal-class-icon" src="/images/icons/class_gray.svg" alt="指定なし">
                <img v-else-if="recipe.meal_class_id == 2" class="meal-class-icon" src="/images/icons/class_purple.svg" alt="容易にかめる">
                <img v-else-if="recipe.meal_class_id == 3" class="meal-class-icon" src="/images/icons/class_pink.svg" alt="歯ぐきでつぶせる">
                <img v-else-if="recipe.meal_class_id == 4" class="meal-class-icon" src="/images/icons/class_orange.svg" alt="舌でつぶせる">
                <img v-else class="meal-type-icon" src="/images/icons/class_green.svg" alt="かまなくてよい">
                <p class="meal-class">{{ recipe.meal_class.name }}</p>
              </div>
            </div>
          </div>
        </main>
        <div class="card-bottom">
            <div class="tag">
              <div class="card-text line-height">
                <a class="text-muted"  v-for="tag in recipe.tags" :key="tag.id" :href="'http://' + httpHost + '/tags/' + `${tag.name}`">
                  {{ tag.name | hashtag }}
                </a>
              </div>
            </div>
        </div>
      </div>
  </div>
</template>


<script>
import moment from "moment"
import RecipeStock from './RecipeStock'

export default {
  components: {
    RecipeStock: RecipeStock,
  },
  props: {
    StockRecipes: {
      type: Array,
      default: [],
    },
    url: {
      type: String,
      default: "",
    },
    s3Avatar: {
      type: String,
      default: "",
    },
    s3Recipe: {
      type: String,
      default: "",
    }
  },
  filters: {
    createdDate: function (date) {
      return moment(date).format("YYYY年MM月DD日");
    },
    hashtag: function (tag) {
      return '#' + tag;
    },
  },
  data() {
    return {
      keyword: '',
      stockRecipes: this.StockRecipes,
      httpHost: this.url,
      s3Avatar: this.s3Avatar,
      s3Recipe: this.s3Recipe,
    }
  },
  computed: {
    // フォームに入力された文字に該当するデータの表示
    filterRecipes() {
      let filtered = [];
      for (let i in this.stockRecipes) {
          let recipe = this.stockRecipes[i];
          if (
            recipe.title.indexOf(this.keyword) !== -1 ||
            recipe.meal_type.name.indexOf(this.keyword) !== -1 ||
            recipe.meal_class.name.indexOf(this.keyword) !== -1
            ){
              filtered.push(recipe);
          }
        }
      return filtered.slice().reverse();
    },
  },
}
</script>