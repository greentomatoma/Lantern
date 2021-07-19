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
     * @test
     */
    public function レシピの一覧表示()
    {
        $response = $this->get(route('recipes.index'));
        $response->assertStatus(200)
            ->assertViewIs(('recipes.index'));
    }


    /**
     * @test
     */
    public function そのレシピの詳細画面表示()
    {
        $recipe = factory(Recipe::class)->create();
        $response = $this->get(route('recipes.show', ['recipe' => $recipe]));
        $response->assertStatus(200)
            ->assertViewIs('recipes.show', ['recipe' => $recipe]);
    }


    /**
     * @test
     */
    public function 未ログインでレシピを投稿できない()
    {
        $response = $this->get(route('recipes.create'));
        $response->assertRedirect('login');
    }


    /**
     * @test
     */
    public function ログインしているとレシピを投稿できる()
    {
        // Userモデルを用意
        $user = factory(User::class)->create(); 
        
        // ログインした上で投稿画面にアクセス
        $response = $this->actingAs($user)
            ->get(route('recipes.create'));

        // レスポンス
        $response->assertStatus(200)
            ->assertViewIs('recipes.create');
    }


    /**
     * @test
     */
    public function レシピ投稿()
    {
        // Userモデルを用意
        $user = factory(User::class)->create(); 
        
        // ログインした上で投稿画面にアクセス
        $response = $this->actingAs($user)
            ->get(route('recipes.create'));

        // レスポンス
        $response->assertStatus(200)
            ->assertViewIs('recipes.create');
    }
}
