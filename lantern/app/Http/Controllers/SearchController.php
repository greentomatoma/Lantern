<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecipeRequest;
use App\Models\Recipe;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = Recipe::query();

        $keyword = '%' . $this->escape($request->input('keyword')) . '%';

        if(!empty($keyword)) {
            $query->where('title', 'LIKE', $keyword)
            ->orWhere('cook_time', 'LIKE', $keyword)
            ->orWhere('ingredients', 'LIKE', $keyword)
            ->get();
            $recipes = $query->get()->sortByDesc('created_at');
        } else {
            $recipes = Recipe::all()->sortByDesc('created_at');
        };
        
        
        // if($request->filled('keyword')) {
        //     $query->where(function($query) use ($keyword) {
        //     $query->where('title', 'LIKE', $keyword)->orWhere('cook_time', 'LIKE', $keyword);
        //     });
        // }

        return view('search.index', [
            'recipes' => $recipes,
            'keyword' => $keyword,
        ]);
        // return view('search.index');

    }


    private function escape(string $value)
    {
        return str_replace(
            ['\\', '%', '_'],
            ['\\\\', '\\%', '\\_'],
            $value
        );
    }
}
