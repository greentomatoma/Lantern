<?php

namespace Tests\Feature;

use App\Models\Recipe;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RecipesControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * 一覧表示
     * @test
     */
    public function レシピの一覧表示()
    {
        $response = $this->get(route('recipes.index'));
        $response->assertOk()
            // 検索フォームがある
            ->assertSee('search');
    }


    /**
     * レシピの詳細画面表示
     * @test
     */
    public function そのレシピの詳細画面表示()
    {
        $recipes = factory(Recipe::class)->create();
        $response = $this->get('/recipes/' . $recipes->id);
        $response->assertOk()
            // 「料理画像」が表示されている
            ->assertSee('recipe-image')
            // 「料理名」が表示されている
            ->assertSee($recipes->title)
            // 「材料」が表示されている
            ->assertSee('ingredients')
            // 「作り方」が表示されている
            ->assertSee('description')
            // 「コメント」が表示されている
            ->assertSee('comment')
            ->assertViewIs('recipes.show', ['recipe' => $recipes]);
    }


    /**
     * レシピ投稿画面遷移
     * @test
     */
    public function 未ログインではレシピ投稿画面へ遷移できない()
    {
        $response = $this->get(route('recipes.create'));
        $response->assertRedirect('login');
    }


    /**
     * レシピ投稿画面遷移
     * @test
     */
    public function ログインしているとレシピ投稿画面へ遷移できる()
    {
        // Userモデルを用意
        $user = factory(User::class)->create(); 
        
        // ログインした上で投稿画面にアクセス
        $response = $this->actingAs($user)
            ->get(route('recipes.create'));

        // レスポンス
        $response->assertOk()
            // 画像入力フォームがある
            ->assertSee('file')
            // 「料理名」入力フォームがある
            ->assertSee('title')
            // 「調理時間」入力フォームがある
            ->assertSee('cook_time')
            // 「料理の種類」入力フォームがある
            ->assertSee('meal_type_id')
            // 「料理の区分」入力フォームがある
            ->assertSee('meal_class_id')
            // 「材料」入力フォームがある
            ->assertSee('ingredients')
            // 「作り方」入力フォームがある
            ->assertSee('description')
            // 「コメント」入力フォームがある
            ->assertSee('comment')
            // 投稿ボタンがある
            ->assertSee('post-button')
            
            ->assertViewIs('recipes.create');
    }


    /**
     * レシピ投稿
     * @test
     */
    public function レシピ投稿()
    {

        $user = factory(User::class)->create();
        $this->actingAs($user);

        //エラーが起きても例外処理をしない
        $this->withoutExceptionHandling();

        $recipes = factory(Recipe::class)->create([
            'user_id' => $user->id,
        ]);

        $this->assertCount(1, Recipe::all());

    }


    /**
     * レシピ編集
     * @test
     */
    public function レシピupdate()
    {
        // ユーザーを用意
        $user = factory(User::class)->create();
        // 認証済みユーザー
        $this->actingAs($user);

        // レシピを１件用意
        $recipe = factory(Recipe::class)->create([
            'user_id' => $user->id,
        ]);

        // 生成したレシピのmeal_type_idを変更
        $response = $this->put('/recipes/' . $recipe->id, [
            'recipes' => [
                'id' => $recipe->id,
                'title' => 'title',
                'cook_time' => 5,
                'ingredients' => 'ingredients',
                'description' => 'description',
                'comment' => 'comment',
                "cooking_img_file" => null,
                'meal_type_id' => 5,
                'meal_class_id' => 4,
                'user_id' => $user->id,
            ],
        ]);

        $response->assertStatus(302);
        $response->assertRedirect();

        // 変更したデータがデータベースにあるか確認
        $this->assertDatabaseHas('recipes', [
            'id' => $recipe->id,
        ]);
    }

    /**
     * レシピ削除
     * @test
     */
    // public function レシピdelete()
    // {
    //     // ユーザーを用意
    //     $user = factory(User::class)->create();
    //     // 認証済みユーザー
    //     $this->actingAs($user);

    //     // レシピを１件用意
    //     $recipe = factory(Recipe::class)->create([
    //         'user_id' => $user->id,
    //     ]);

    //     $this->assertDatabaseHas('recipes', [
    //         'id' => $recipe->id,
    //     ]);

    //     $response = $this->from('/recipes')->delete('/recipes/' . $recipe->id);
    //     // $response->assertRedirect('recipes.index');

    //     $this->assertDatabaseMissing('recipes', [
    //         'id' => $recipe->id,
    //     ]);
    // }
}