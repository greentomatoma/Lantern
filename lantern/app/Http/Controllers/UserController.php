<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

        $avatar_img_file = $request->file('avatar_img_file');


        // 画像保存処理
        if($avatar_img_file) {
            // $recipeImagePath = $recipe_image->store('public/recipes');
            $path = Storage::disk('public')->putFile('avatars', $avatar_img_file);

            $avatarFileName = basename($path);
            // $fileName = $this->saveRecipeImage($request->file('cooking_img_file'));
            $user->avatar_img_file = $avatarFileName;
        } else {
            $path = null;
        }
        
        $user->save();

        return redirect()
            ->route('users.show', [
                'name' => $user->name,
                'avatar_img_file' => $user->avatar_img_file,
                ])
            ->with('status', 'プロフィールを変更しました');
    }
}
