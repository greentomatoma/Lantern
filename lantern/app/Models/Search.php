<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    public function getSearchesCountAttribute()
    {
        
    }

    public function scopeSearchQuery($query, $keywords = null)
    {
        foreach ($keywords as $keyword) {
            $query->where('title', 'like', "%$keyword%")
                  ->orWhere('cook_time', 'like', "%$keyword%")
                  ->orWhere('ingredients', 'like', "%$keyword%");
        }
    }
}
