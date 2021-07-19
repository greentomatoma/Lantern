<?php

namespace Tests\Feature;

use App\Models\Recipe;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RecipeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * そのレシピがストックされているか判定
     * @test
     */
    public function 引数がnullの時はfalseが返る()
    {
        $recipe = factory(Recipe::class)->create();
        $result = $recipe->isStockedBy(null);
        $this->assertFalse($result);
    }


    /**
     * そのレシピがストックされているか判定
     * @test
     */
    public function ユーザーがそのレシピをストックしている時はTrueを返す()
    {
        // レシピ１件分を用意
        $recipe = factory(Recipe::class)->create();
        // ユーザーを用意
        $user = factory(User::class)->create();
        // そのレシピをユーザーがストックしている
        $recipe->stocks()->attach($user);
        
        $result = $recipe->isStockedBy($user);
        $this->assertTrue($result);
    }


    /**
     * そのレシピがストックされているか判定
     * @test
     */
    public function ユーザーがそのレシピをストックしていない時はFalseを返す()
    {
        // レシピ１件分を用意
        $recipe = factory(Recipe::class)->create();
        // ユーザーを用意
        $user = factory(User::class)->create();
        // もう一人のユーザー
        $another = factory(User::class)->create();
        // そのレシピを自身以外のユーザーがストックしている
        $recipe->stocks()->attach($another);

        $result = $recipe->isStockedBy($user);
        $this->assertFalse($result);
    }
}
