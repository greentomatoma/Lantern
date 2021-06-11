<?php

namespace App\Http\Controllers;

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
}
