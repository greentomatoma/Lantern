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
        return view('recipes.index', ['recipes' => $this->recipe->getOllRecipes()]);
    }
    
    
    public function create()
    {
        $allTagNames = Tag::all()->map(function($tag) {
            return ['text' => $tag->name]; 
        });

        $meal_types = MealType::orderBy('sort_no')->get();
        $meal_classes = MealClass::orderBy('sort_no')->get();

        return view('recipes.create', [
            'allTagNames' => $allTagNames,
            'meal_types' => $meal_types,
            'meal_classes' => $meal_classes,
        ]);
    }


    public function store(RecipeRequest $request, Recipe $recipe)
    {
        $recipe->fill($request->all());
        $recipe->user_id = $request->user()->id;

        // 料理画像保存処理
        $this->recipe->storeRecipeImage($request, $recipe);

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
          $tagNames = $recipe->tags->map(function($tag) {
            return ['text' => $tag->name];
          });

          $allTagNames = Tag::all()->map(function($tag) {
            return ['text' => $tag->name]; 
          });

          $meal_types = MealType::orderBy('sort_no')->get();
          $meal_classes = MealClass::orderBy('sort_no')->get();

          return view('recipes.edit', [
              'recipe' => $recipe,
              'tagNames' => $tagNames,
              'allTagNames' => $allTagNames,
              'meal_types' => $meal_types,
              'meal_classes' => $meal_classes,
              ]);
    }


    public function update(RecipeRequest $request, Recipe $recipe)
    {
        $recipe->fill($request->all())->save();
        
        $recipe->tags()->detach();
        $this->recipe->storeTags($request, $recipe);

        return redirect()->route('recipes.index');
    }


    public function destroy(Recipe $recipe)
    {
        $delRecipeId = Recipe::find($recipe->id);
        // storage/app/public/imagesから画像ファイルを削除
        $delPath = '/public/recipes/' . $delRecipeId->cooking_img_file;
        if(Storage::exists($delPath)) {
            Storage::delete($delPath);
        }
        // $delRecipeImage = $delRecipeId->cooking_img_file;
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
