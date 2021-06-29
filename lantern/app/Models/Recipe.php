<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\User;

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

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }

    public function stocks(): BelongsToMany
    {
        return $this->belongsToMany('App\User', 'stocks')->withTimestamps();
    }

    //  レシピを保存済みか判定
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

    public function mealType()
    {
        return $this->belongsTo(MealType::class, 'meal_type_id');
    }

    public function mealClass()
    {
        return $this->belongsTo(MealClass::class, 'meal_class_id');
    }

}
