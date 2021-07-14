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
     * @param \App\Http\Requests\RecipeRequest $request
              \App\Models\Recipe $recipe
     * @return bool
     */
    public function storeRecipeImage($request, $recipe)
    {
        $recipe_image = $request->file('cooking_img_file');

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
     * タグ情報の保存処理
     * @param \App\Http\Requests\RecipeRequest $request
              \App\Models\Recipe $recipe
     * @return bool
     */
    public function storeTags($request, $recipe)
    {
        $request->tags->each(function($tagName) use ($recipe) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $recipe->tags()->attach($tag);
        });
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
