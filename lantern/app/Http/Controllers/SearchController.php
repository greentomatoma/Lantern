<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecipeRequest;
use App\Models\Recipe;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(RecipeRequest $request)
    {
        $query = Recipe::query();

        $keyword = '%' . $this->escape($request->input('keyword')) . '%';
        if($request->filled('keyword')) {
            $query->where(function($query) use ($keyword) {
            $query->where('title', 'LIKE', $keyword)->orWhere('cook_time', 'LIKE', $keyword);

            });
        }

        $recipes = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('search', [
            'recipes' => $recipes,
            'keyword' => $keyword,
        ]);
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
