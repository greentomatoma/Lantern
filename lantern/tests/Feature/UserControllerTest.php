<?php

namespace Tests\Feature;

use App\Models\Recipe;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;


    /**
     * ユーザーの登録
     * @test
     */
    public function ユーザーを取得できる()
    {
        // Userモデルを用意
        $user = factory(User::class)->create([
            'name' => 'test',
        ]);
        $this->assertInstanceOf(User::class, $user);

        return $user;
    }

    /**
     * 登録されたユーザーのIdを取得
     * @test
     * @depends ユーザーを取得できる
     */
    public function Idを取得できる($user)
    {
        $this->assertEquals(1, $user->id);
    }


    /**
     * 登録されたユーザーのNameを取得
     * @test
     * @depends ユーザーを取得できる
     */
    public function Nameを取得できる($user)
    {
        $this->assertEquals('test', $user->name);
    }


    /**
     * ユーザーに紐づくレシピの取得
     * @test
     */
    public function そのユーザーに紐づくレシピを取得できる()
    {

        $count = 3;

        $user = factory(User::class)->create();

        $recipes = factory(Recipe::class, $count)->create([
            'user_id' => $user->id,
        ]);

        $response = Recipe::find($user->id)->count();

        $this->assertEquals($count, $response);
    }


    /**
    * ユーザーに紐づくレシピの表示
    * @test
    */
    public function ユーザーページでのそのユーザーに紐づくレシピの表示()
    {
        $user = factory(User::class)->create();

        $recipes = factory(Recipe::class)->create([
            'user_id' => $user->id,
        ]);

        $response = $this->get(route('users.show', [
            'name' => $user->name,
            'recipe' => $recipes
        ]));

        $response->assertStatus(200)
            ->assertViewIs('users.show', [
                'name' => $user->name,
               'recipe' => $recipes,
        ]);
    }


   /**
    * プロフィール編集画面
    * @test
    * @depends ユーザーを取得できる
    */
    public function 自身のマイページではプロフィール編集画面へ遷移できる($user)
    {
        $response = $this
        // 認証済みユーザー
        ->actingAs($user)
        // // マイページへ遷移できる
        // ->get('/users/' . $user->name)
        // // プロフィール編集ボタンが表示されている
        // ->assertSee('class="edit-profile"')
        // プロフィール編集画面へ遷移できる
        ->get('/users/' . $user->name . '/edit-profile');
        
        $response->assertOk();
    }



}
