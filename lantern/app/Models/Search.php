<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Search extends Model
{

    /**
     * 空白区切りで検索欄に入力された場合
     * @param string $keyword
     * @return Array
     */
    public function pregSplit($keyword)
    {
        // 全角空白→半角空白
        $keyword = mb_convert_kana( $keyword, "s" );
        return preg_split('/[\p{Z}\p{Cc}]++/u', $keyword, -1, PREG_SPLIT_NO_EMPTY);
    }


    /**
     * 検索処理
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @var string[]|false $keywords
     * @return \Illuminate\Database\Eloquent\Builder $query
     */
    public function searchQuery($query, $keywords = null)
    {
        if(!empty($keywords)) {
            foreach ($keywords as $keyword) {
                $query->where('title', 'like', "%$keyword%")
                    ->orWhere('cook_time', 'like', "%$keyword%")
                    ->orWhere('ingredients', 'like', "%$keyword%")
                    ->orWhereHas('tags', function($query) use ($keyword) {
                        $query->where('name', 'like', "%$keyword%" );
                    })
                    ->orWhereHas('mealType', function($query) use ($keyword) {
                        $query->where('name', 'like', "%$keyword%" );
                    })
                    ->orWhereHas('mealClass', function($query) use ($keyword) {
                        $query->where('name', 'like', "%$keyword%" );
                    });
            }
        }
        return $query->get()->sortByDesc('created_at')
        ->load('user', 'stocks', 'tags', 'mealType', 'mealClass');
    }


    /**
     * 検索ヒット数カウント
     * @param mixed $recipes
     * @return int
     */
    public function searchCount($recipes)
    {
        return $recipes->count();
    }
}
