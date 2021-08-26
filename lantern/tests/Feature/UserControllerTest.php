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

        $recipe = factory(Recipe::class, $count)->create([
            'user_id' => $user->id,
        ]);

        $this->assertEquals($count, count($recipe));
    }


    // /**
    //  * ユーザーに紐づくレシピの表示
    //  * @test
    //  */
    public function そのユーザーに紐づくレシピの表示()
    {
        $user = factory(User::class)->create();

        $recipe = factory(Recipe::class)->create([
            'user_id' => $user->id,
        ]);

        $response = $this->get(route('users.show', [
            'user' => $user,
            'recipe' => $recipe
        ]));

        $response->assertStatus(200)
            ->assertViewIs('users.show', [
                'user' => $user,
               'recipe' => $recipe,
        ]);

    }

}
