<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\MealType;
use Faker\Generator as Faker;

$factory->define(MealType::class, function (Faker $faker) {
    return [
        'name' => '主食',
        'sort_no' => 1,
    ];
});
