<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\MealClass;
use Faker\Generator as Faker;

$factory->define(MealClass::class, function (Faker $faker) {
    return [
        'name' => '指定なし',
        'sort_no' => 1,
    ];
});
