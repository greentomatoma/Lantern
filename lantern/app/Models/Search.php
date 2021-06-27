<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    public static function scopeSearchWord($input, int $limit = -1): array
    {
        return preg_split('/[\p{Z}\p{Cc}]++/u', $input, $limit, PREG_SPLIT_NO_EMPTY);
    }

    public static function scopeSearchQuery($query, $keywords = null)
    {
        foreach ($keywords as $keyword) {
            $query->where('title', 'like', "%$keyword%")
                  ->orWhere('cook_time', 'like', "%$keyword%")
                  ->orWhere('ingredients', 'like', "%$keyword%");
        }
        return $query->get()->sortByDesc('created_at');
    }
}
