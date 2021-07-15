<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\User;
use Illuminate\Support\Facades\Storage;

class Recipe extends Model
{
    protected $fillable = [
        'title',
        'cook_time',
        'ingredients',
        'description',
        'comment',
        'cooking_img_file',
        'meal_type_id',
        'meal_class_id',
    ];


    /**
     * 全てのレシピ情報を取得
     * @return Object
     */
    public function getOllRecipes()
    {
        return $this->all()->sortByDesc('created_at')
        ->load('user', 'stocks', 'tags', 'mealType', 'mealClass');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }

    public function stocks(): BelongsToMany
    {
        return $this->belongsToMany('App\User', 'stocks')->withTimestamps();
    }


    /**
     * 料理画像の保存処理
     * @param $recipe_image
     * @param \App\Models\Recipe $recipe
     * @return bool
     */
    public function storeRecipeImage($recipe_image, $recipe)
    {
        if($recipe_image) {
            $path = Storage::disk('public')->putFile('recipes', $recipe_image);
            $recipeFileName = basename($path);
            $recipe->cooking_img_file = $recipeFileName;
        } else {
            $path = null;
        }

        return $recipe->save();
    }


    /**
     * 料理画像の削除処理
     * @param $recipe
     * @return bool
     */
    public function deleteRecipeImage($recipe)
    {
        $delRecipeId = $this->find($recipe->id);
        // storage/app/public/imagesから画像ファイルを削除
        $delPath = '/public/recipes/' . $delRecipeId->cooking_img_file;
        if(Storage::exists($delPath)) {
            Storage::delete($delPath);
        }
        return $recipe->delete();
    }


    /**
     * 登録済みのタグ情報を取得
     * 編集・更新画面で使用
     * @param $recipe
     * @return Object
     */
    public function tagNames($recipe)
    {
        $recipe->tags->map(function($tag) {
            return ['text' => $tag->name];
        });
    }


    /**
     * 登録済みの全てのタグ情報を取得
     * 自動補完で使用
     * @param $tag
     * @return Object
     */
    public function allTagNames()
    {
         Tag::all()->map(function($tag) {
            return ['text' => $tag->name];
        });
    }


    /**
     * タグ情報の保存処理
     * @param \App\Http\Requests\RecipeRequest $request
              \App\Models\Recipe $recipe
     * @return bool
     */
    public function storeTags($request, $recipe)
    {
        $request->tags->each(function($tagName) use ($recipe) {
            // テーブルに同一のタグが存在するか確認
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $recipe->tags()->attach($tag);
        });
    }

    
    /**
     * 料理の種類の情報取得
     * @return Collection
     */
    public function getMealType()
    {
        return MealType::orderBy('sort_no')->get();
    }


    /**
     * 料理の区分の情報取得
     * @return Collection
     */
    public function getMealClass()
    {
        return MealClass::orderBy('sort_no')->get();
    }


    /**
     * レシピを保存済みか判定
     * @param $user
     * @return bool
     */
    public function isStockedBy(?User $user): bool
    {
        return $user
        ? (bool)$this->stocks->where('id', $user->id)->count()
        : false;
    }


    /**
     * そのレシピが保存された数をカウント
     * @return int
     */
    public function getCountStocksAttribute(): int
    {
        return $this->stocks->count();
    }


    public function tags(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Tag')->withTimestamps();
    }

    public function mealType(): BelongsTo
    {
        return $this->belongsTo(MealType::class, 'meal_type_id');
    }

    public function mealClass(): BelongsTo
    {
        return $this->belongsTo(MealClass::class, 'meal_class_id');
    }

}
