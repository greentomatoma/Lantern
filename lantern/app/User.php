<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * 該当するユーザーネームを取得
     * @param string $name
     * @return String
     */
    public function getUser($name)
    {
        return $this->where('name', $name)->first();
    }


    /**
     * そのユーザーが投稿した全てのレシピ情報を取得
     * @return Object
     */
    public function getAllRecipes($user)
    {
        return $user->recipes->sortByDesc('created_at')
        ->load('user', 'stocks', 'tags', 'mealType', 'mealClass');
    }


    /**
     * 料理画像の保存処理
     * @param $avatar_image
     * @param \App\Models\User $user
     * @return bool
     */
    public function storeAvatarImage($avatar_image, $user)
    {
        if($avatar_image) {
            $path = Storage::disk('s3')->putFile('avatars', $avatar_image, 'public');
            $avatarFileName = basename($path);
            $user->avatar_img_file = $avatarFileName;
        } else {
            $path = null;
        }
    }


    /**
     * アバター画像の更新処理
     * @param \Illuminate\Http\UploadedFile $avatar_img_file
     * @param \Illuminate\Contracts\Auth\Authenticatable $user
     * @return String
     */
    public function updateAvatarImage($request, $user)
    {
        $AvatarId = $user->find($user->id);

        if($request->hasFile('avatar_img_file')) {
            $this->deleteAvatarImage($AvatarId);
            $path = $request->file('avatar_img_file')->store('avatars');
            $avatarFileName = basename($path);
            $user->avatar_img_file = $avatarFileName;
        } else {
            $path = null;
        }
    }


    /**
     * アバター画像の削除処理
     * @param $AvatarId
     * @return bool
     */
    public function deleteAvatarImage($AvatarId)
    {
        // storage/app/public/avatarsから画像ファイルを削除
        $delPath = 'avatars/' . $AvatarId->avatar_img_file;
        if(Storage::exists($delPath)) {
            Storage::delete($delPath);
        }
    }


    /**
     * そのユーザーが保存した全てのレシピ情報を取得
     * @param $user
     * @return Object
     */
    public function getAllStockedRecipes($user)
    {
        return $user->note->sortByDesc('created_at')
        ->load('user', 'stocks', 'tags', 'mealType', 'mealClass');
    }


    /**
     * レシピを保存済みか判定
     * @param $user
     * @return bool
     */
    public function isStockedBy(?User $user): bool
    {
        return $user 
            ?(bool)$this->stocks->where('id', $user->id)->count()
            : false;
    }

    /**
     * ホスト名を取得
     * @param $url
     * @return String
     */
    public function getUrl($hostname)
    {
        $url = "";

        switch(true) {
            case($hostname === 'd9a6ea0a5c20'):
                $url = 'localhost';
                break;
            case($hostname === '13.115.34.128'):
                $url = '13.115.34.128';
                break;
        }

        return $url;
    }


    public function recipes(): HasMany
    {
        return $this->hasMany('App\Models\Recipe');
    }


    public function note(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Recipe', 'stocks')->withTimestamps();
    }

}
