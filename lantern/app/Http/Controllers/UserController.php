<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function show(string $name)
    {
        $user = User::where('name', $name)->first();
        $recipes = $user->recipes->sortByDesc('created_at');

        return view('users.show', [
            'user' => $user,
            'recipes' => $recipes,
        ]);
    }

    public function edit(string $name, User $user)
    {
        $user = User::where('name', $name)->first();
        return view('users.edit', ['user' => $user]);
    }
}
