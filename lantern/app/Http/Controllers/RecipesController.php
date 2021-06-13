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

        // 画像保存処理
        if($request->has('cooking_img_file')) {
            $fileName = $this->saveImage($request->file('cooking_img_file'));
            $recipe->cooking_img_file = $fileName;
        }

        $recipe->save();

        return redirect()->route('article.index');
    }


    /**
     * レシピ画像をリサイズして保存
     * 
     * @param UploadFile $file アップロードされたレシピ画像
     * @return string レシピ画像
     */

    private function saveImage(UploadedFile $file): string
    {
        $tempPath = $this->makeTempPath();

        Image::make($file)->fit(300, 200)->save($tempPath);

        $filePath = Storage::disk('public')
            ->putFile('cooking_img_file', new File($tempPath));

        return basename($filePath);
    }


     /**
      * 一時的なファイルを生成してパスを返す
      *
      * @return string ファイルパス
      */

      private function makeTempPath(): string
      {
          $tmp_fp = tmpfile();
          $meta = stream_get_meta_data($tmp_fp);

          return $meta["uri"];
      }
}
