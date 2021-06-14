<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecipeRequest;
use Illuminate\Http\Request;
use App\Models\Recipe;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class RecipesController extends Controller
{
    public function index()
    {
        $recipes = Recipe::all()->sortByDesc('created_at');

        return view('recipes.index', ['recipes' => $recipes]);
    }

    
    public function create()
    {
        return view('recipes.create');
    }


    public function store(RecipeRequest $request, Recipe $recipe)
    {
        $recipe->fill($request->all());
        $recipe->user_id = $request->user()->id;

        $recipe_image = $request->file('cooking_img_file');

        // 画像保存処理
        if($recipe_image) {
            // $recipeImagePath = $recipe_image->store('public/recipes');
            $path = Storage::put('/public/recipes', $recipe_image);
            $recipeFileName = basename($path);
            // $fileName = $this->saveRecipeImage($request->file('cooking_img_file'));
            $recipe->cooking_img_file = $recipeFileName;
        } else {
            $path = null;
        }
        
        $recipe->save();
        // dd(basename($recipe));

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
          return view('recipes.edit', ['recipe' => $recipe]);
    }


    public function update(RecipeRequest $request, Recipe $recipe)
    {
        $recipe->fill($request->all())->save();
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
        // dd($delPath);
        $recipe->delete();
        return redirect()->route('recipes.index');
    }
}
