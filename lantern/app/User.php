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
     * アバター画像の保存処理
     * @param \Illuminate\Http\UploadedFile $avatar_img_file
     * @param \Illuminate\Contracts\Auth\Authenticatable $user
     * @return String
     */
    public function updateAvatarImage($request, $user)
    {
        $AvatarId = $user->find($user->id);

        if($request->hasFile('avatar_img_file')) {
            $this->deleteAvatarImage($AvatarId);
            $path = $request->file('avatar_img_file')->store('public/avatars');
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
        $delPath = '/public/avatars/' . $AvatarId->avatar_img_file;
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


    public function recipes(): HasMany
    {
        return $this->hasMany('App\Models\Recipe');
    }


    public function note(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Recipe', 'stocks')->withTimestamps();
    }

}
