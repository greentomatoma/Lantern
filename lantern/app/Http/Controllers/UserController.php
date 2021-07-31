<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function show(string $name)
    {
        // ユーザー情報を取得
        $user = $this->user->getUser($name);

        return view('users.show', [
            'user' => $user,
            'recipes' => $this->user->getAllRecipes($user),
        ]);
    }


    public function edit(string $name, User $user)
    {
        $user = $this->user->getUser($name);
        return view('users.edit', ['user' => $user]);
    }


    public function update(UserRequest $request, User $user)
    {
        $user = Auth::user();

        $user->name = $request->input('name');
        
        // 画像保存処理
        $this->user->updateAvatarImage($request, $user);
        
        $user->save();

        return redirect()
            ->route('users.show', [
                'name' => $user->name,
                'avatar_img_file' => $user->avatar_img_file,
                ])
            ->with('status', 'プロフィールを変更しました');
    }


    public function note(string $name)
    {
        $user = $this->user->getUser($name);

        // $url = "";
        // $hostname = php_uname("n");

        // switch(true) {
        //     case($hostname === 'd9a6ea0a5c20'):
        //         $url = 'localhost';
        //         break;
        //     case($hostname === '13.115.34.128'):
        //         $url = '13.115.34.128';
        //         break;
        // }

        // if (strpos(gethostname(), 'ap-northeast-1.compute.internal') === true) {
        //     $url = 'localhost';
        // } else {
        //     $url = '13.115.34.128';
        // }

        return view('users.note', [
            'user' => $user,
            'recipes' => $this->user->getAllStockedRecipes($user),
            // 'url' => $url
        ]);
    }
}
