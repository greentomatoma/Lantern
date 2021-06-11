<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecipeRequest;
use Illuminate\Http\Request;
use App\Models\Recipe;

class RecipesController extends Controller
{
    public function index()
    {
        $recipes = Recipe::all()->sortByDesc('created_at');

        return view('recipes.index', ['recipes' => $recipes]);
    }

    
    public function create()
    {
        return view('recipes.create');
    }


    public function store(RecipeRequest $request, Recipe $recipe)
    {
        $recipe->fill($request->all());
        $recipe->user_id = $request->user()->id;
        $recipe->save();

        return redirect()->route('article.index');
    }
}
