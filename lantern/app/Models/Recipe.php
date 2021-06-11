<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Recipe extends Model
{
    protected $fillable = [
        'title',
        'cook_time',
        'ingredients',
        'description',
        'comment',
        'cooking_img_file',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }
}
