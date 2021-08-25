<?php

namespace Tests\Feature;

use App\Models\Recipe;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    /**
     * @test
     */
    public function そのユーザーのユーザーページを表示()
    {
        // Userモデルを用意
        $user = factory(User::class)->create();

        // レシピ１件分を用意
        $recipe = factory(Recipe::class)->create();
        $recipes = $user->$recipe;
        
        $response = $this->get(route('users.show', [
            'user' => $user,
            'recipes' => $recipes,
        ]));

        $response->assertStatus(200)
            ->assertViewIs(('users.show'));
    }
}
