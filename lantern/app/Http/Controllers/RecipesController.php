<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecipeRequest;
use App\Models\MealClass;
use App\Models\MealType;
use App\Models\Recipe;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class RecipesController extends Controller
{

    public function __construct(Recipe $recipe)
    {
        $this->recipe = $recipe;
    }


    public function index()
    {
        return view('recipes.index', ['recipes' => $this->recipe->getAllRecipes()]);
    }
    
    
    public function create()
    {
        return view('recipes.create', [
            // 全てのタグ情報を取得
            'allTagNames' => $this->recipe->allTagNames(),
            // 料理の種類
            'meal_types' => $this->recipe->getMealType(),
            // 料理の区分
            'meal_classes' => $this->recipe->getMealClass(),
        ]);
    }


    public function store(RecipeRequest $request, Recipe $recipe)
    {
        $recipe->fill($request->all());
        $recipe->user_id = $request->user()->id;

        // 画像ファイル情報を取得
        $recipe_image = $request->file('cooking_img_file');
        // 料理画像保存処理
        $this->recipe->storeRecipeImage($recipe_image, $recipe);

        // タグ情報保存処理
        $this->recipe->storeTags($request, $recipe);

        return redirect()->route('recipes.index')->with('message', 'レシピを投稿しました。');
    }


      public function show(Recipe $recipe)
      {
          return view('recipes.show', ['recipe' => $recipe]);
      }


      public function edit(Recipe $recipe)
      {
          return view('recipes.edit', [
              'recipe' => $recipe,
              // 登録済みのタグ情報を取得
              'tagNames' => $this->recipe->tagNames($recipe),
              // 全てのタグ情報を取得
              'allTagNames' => $this->recipe->allTagNames(),
              // 料理の種類の情報取得
              'meal_types' => $this->recipe->getMealType(),
              // 料理の区分の情報取得
              'meal_classes' => $this->recipe->getMealClass(),
              ]);
    }


    public function update(RecipeRequest $request, Recipe $recipe)
    {
        $recipe->fill($request->all());
        
        // 一度そのレシピに紐づくタグ情報を削除
        $recipe->tags()->detach();
        // タグ情報の保存処理
        $this->recipe->storeTags($request, $recipe);

        // 料理画像更新処理
        $this->recipe->updateRecipeImage($request, $recipe);

        $recipe->save();

        return redirect()->route('recipes.index')->with('message', 'レシピを変更しました。');
    }


    public function destroy(Recipe $recipe)
    {
        // 削除するレシピのID取得
        $delRecipeId = $recipe->find($recipe->id);
        // 画像削除処理
        $this->recipe->deleteRecipeImage($delRecipeId);

        $recipe->delete();
        return redirect()->route('recipes.index');
    }

    
    // レシピ保存機能
    public function stock(Recipe $recipe)
    {
        $user_id = Auth::id();

        $recipe->stocks()->detach($user_id);
        $recipe->stocks()->attach($user_id);

        return [
            'userId' => $user_id,
            'recipeId' => $recipe->id,
            'countStocks' => $recipe->count_stocks,
        ];
    }

    // レシピ保存解除
    public function unstock(Recipe $recipe)
    {
        $user_id = Auth::id();

        $recipe->stocks()->detach($user_id);

        return [
            'userId' => $user_id,
            'recipeId' => $recipe->id,
            'countStocks' => $recipe->count_stocks,
        ];

    }
}
