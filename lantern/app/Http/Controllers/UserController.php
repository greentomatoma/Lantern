<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

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


    public function update(UserRequest $request, User $user)
    {
        $user = Auth::user();

        $user->name = $request->input('name');
        $user->save();

        return redirect()
            ->route('users.show', ['name' => $user->name])
            ->with('status', 'プロフィールを変更しました');
    }
}
