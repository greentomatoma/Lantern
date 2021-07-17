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
            'allTagNames' => $this->recipe->allTagNames(),
            'meal_types' => $this->recipe->getMealType(),
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

        return redirect()->route('recipes.index');
    }


      public function show(Recipe $recipe)
      {
          return view('recipes.show', ['recipe' => $recipe]);
      }


      public function edit(Recipe $recipe)
      {
          return view('recipes.edit', [
              'recipe' => $recipe,
              'tagNames' => $this->recipe->tagNames($recipe),
              'allTagNames' => $this->recipe->allTagNames(),
              'meal_types' => $this->recipe->getMealType(),
              'meal_classes' => $this->recipe->getMealClass(),
              ]);
    }


    public function update(RecipeRequest $request, Recipe $recipe)
    {
        $recipe->fill($request->all());
        
        $recipe->tags()->detach();
        $this->recipe->storeTags($request, $recipe);

        // 料理画像更新処理
        $this->recipe->updateRecipeImage($request, $recipe);

        $recipe->save();

        return redirect()->route('recipes.index');
    }


    public function destroy(Recipe $recipe)
    {
        $delRecipeId = $recipe->find($recipe->id);
        $this->recipe->deleteRecipeImage($delRecipeId);

        $recipe->delete();
        return redirect()->route('recipes.index');
    }

    
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
