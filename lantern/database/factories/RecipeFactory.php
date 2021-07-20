<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\MealClass;
use App\Models\MealType;
use App\Models\Recipe;
use App\User;
use Faker\Generator as Faker;

$factory->define(Recipe::class, function (Faker $faker) {
    return [
        'title' => $faker->text(50),
        'cook_time' => $faker->randomDigitNotNull,
        'ingredients' => $faker->text(500),
        'description' => $faker->text(1000),
        'comment' => $faker->text(1000),
        'user_id' => function() {
            return factory(User::class);
        },
        'meal_type_id' => function() {
            return factory(MealType::class);
        },
        'meal_class_id' => function() {
            return factory(MealClass::class);
        },
    ];
});
