<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecipeRequest;
use App\Models\Recipe;
use App\Models\Search;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    public function __construct(Search $search)
    {
        $this->search = $search;
    }


    public function index(Request $request)
    {
        $query = Recipe::query();

        // エスケープ処理
        $keyword = $this->escape($request->input('keyword'));
        
        // 空白区切りで文字列を分割
        $keywords = $this->search->pregSplit($keyword);

        // 検索処理
        $recipes = $this->search->searchQuery($query, $keywords);

        return view('search.index', [
            'recipes' => $recipes,
            'keywords' => $keywords,
            'searchCount' => $this->search->searchCount($recipes),
        ]);
    }


    /**
     * 検索欄に文字が入力された際、str_replaceを実行する
     * @param string $value
     * @return string $value
     */
    private function escape(string $value = null)
    {
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
