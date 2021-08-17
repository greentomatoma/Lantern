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

        // アバター画像のファイル情報を取得
        $avatar_image = $request->file('avatar_img_file');
        

        // ファイルデータがすでに存在していれば更新処理を行う
        if(!empty($user->avatar_img_file)) {
            // 画像更新処理
            $this->user->updateAvatarImage($request, $user);
        }else{
            // ファイルデータが存在していなければ画像保存処理を行う
            $this->user->storeAvatarImage($avatar_image, $user);
        }
        
        $user->save();

        return redirect()
            ->route('users.show', [
                'name' => $user->name,
                'avatar_img_file' => $user->avatar_img_file,
                ])
            ->with('message', 'プロフィールを変更しました');
    }


    public function note(string $name)
    {
        $user = $this->user->getUser($name);

        // ホスト名を取得
        $hostname = php_uname("n");
        $url = $this->user->getUrl($hostname);

        // S3に保存されている画像データのディレクトリパスを取得
        $s3_avatar = Storage::disk('s3')->url("avatars/");
        $s3_recipe = Storage::disk('s3')->url("recipes/");

        return view('users.note', [
            'user' => $user,
            'recipes' => $this->user->getAllStockedRecipes($user),
            'url' => $url,
            's3_avatar' => $s3_avatar,
            's3_recipe' => $s3_recipe,
        ]);
    }
}
