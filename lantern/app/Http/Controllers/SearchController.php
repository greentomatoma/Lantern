<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecipeRequest;
use App\Models\Recipe;
use App\Models\Search;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = Recipe::query();

        $keyword = $this->escape($request->input('keyword'));
        
        $keywords = preg_split('/[\p{Z}\p{Cc}]++/u', $keyword, -1, PREG_SPLIT_NO_EMPTY);

        // foreach ($keywords as $keyword) {
        //     if(!empty($keyword)) {
        //         $query->where('title', 'like', "%$keyword%")
        //               ->orWhere('cook_time', 'like', "%$keyword%")
        //               ->orWhere('ingredients', 'like', "%$keyword%");
        //         // return $recipes = $query->get()->sortByDesc('created_at');
        //     } else  {
        //         // 検索欄に何も記入せず、検索した場合
        //         // return $recipes = Recipe::all()->sortByDesc('created_at');
        //     }
        // }

        if(!empty($keywords)) {
            foreach ($keywords as $keyword) {
                $query->where('title', 'like', "%$keyword%")
                    ->orWhere('cook_time', 'like', "%$keyword%")
                    ->orWhere('ingredients', 'like', "%$keyword%")
                    ->orWhereHas('tags', function($query) use ($keyword) {
                        $query->where('name', 'like', "%$keyword%" );
                    });
            }
        }

        $recipes = $query->get()->sortByDesc('created_at')
        ->load('user', 'stocks', 'tags', 'mealType', 'mealClass');

        $searchCount = $query->get()->count();

        return view('search.index', [
            'recipes' => $recipes,
            'keywords' => $keywords,
            'searchCount' => $searchCount,
        ]);
    }


    private function escape(string $value = null)
    {
        // 検索欄に文字が入力された際、str_replaceを実行する
        if(!$value) {
            return $value;
        }

        return str_replace(
            ['\\', '%', '_'],
            ['\\\\', '\\%', '\\_'],
            $value
        );
    }
}
