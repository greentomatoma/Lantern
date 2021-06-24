<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecipeRequest;
use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Tag;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use phpDocumentor\Reflection\DocBlock\Tag as DocBlockTag;

class RecipesController extends Controller
{
    public function index()
    {
        $recipes = Recipe::all()->sortByDesc('created_at');

        return view('recipes.index', ['recipes' => $recipes]);
    }

    
    public function create()
    {
        $allTagNames = Tag::all()->map(function($tag) {
            return ['text' => $tag->name]; 
        });

        return view('recipes.create', [
            'allTagNames' => $allTagNames,
        ]);
    }


    public function store(RecipeRequest $request, Recipe $recipe)
    {
        $recipe->fill($request->all());
        $recipe->user_id = $request->user()->id;

        $recipe_image = $request->file('cooking_img_file');

        // 画像保存処理
        if($recipe_image) {
            // $recipeImagePath = $recipe_image->store('public/recipes');
            $path = Storage::disk('public')->putFile('recipes', $recipe_image);

            $recipeFileName = basename($path);
            // $fileName = $this->saveRecipeImage($request->file('cooking_img_file'));
            $recipe->cooking_img_file = $recipeFileName;
        } else {
            $path = null;
        }
        
        $recipe->save();

        $request->tags->each(function($tagName) use ($recipe) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $recipe->tags()->attach($tag);
        });

        return redirect()->route('recipes.index');
    }


    /**
     * レシピ画像をリサイズして保存
     * 
     * @param UploadFile $file アップロードされたレシピ画像
     * @return string レシピ画像
     */

    // private function saveRecipeImage(UploadedFile $file): string
    // {
    //     $tempPath = $this->makeTempPath();

    //     Image::make($file)->fit(300, 200)->save($tempPath);

    //     $filePath = Storage::disk('public')
    //         ->putFile('recipes', new File($tempPath));

    //     return basename($filePath);
    // }


       /**
      * 一時的なファイルを生成してパスを返す
      *
      * @return string ファイルパス
      */
    //   private function makeTempPath(): string
    //   {
    //       $tmp_fp = tmpfile();
    //       $meta   = stream_get_meta_data($tmp_fp);
    //       return $meta["uri"];
    //   }


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

          return view('recipes.edit', [
              'recipe' => $recipe,
              'tagNames' => $tagNames,
              'allTagNames' => $allTagNames,
              ]);
    }


    public function update(RecipeRequest $request, Recipe $recipe)
    {
        $recipe->fill($request->all())->save();
        
        $recipe->tags()->detach();
        $request->tags->each(function($tagName) use ($recipe) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $recipe->tags()->attach($tag);
        });

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
