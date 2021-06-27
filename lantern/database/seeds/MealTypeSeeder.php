<?php

use Illuminate\Database\Seeder;
use App\Models\MealType;

class MealTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(MealType::class)->create([
            'id' => 1,
            'name' => '主食',
            'sort_no' => 1,
        ]);
        factory(MealType::class)->create([
            'id' => 2,
            'name' => '主菜',
            'sort_no' => 2,
        ]);
        factory(MealType::class)->create([
            'id' => 3,
            'name' => '副菜',
            'sort_no' => 3,
        ]);
        factory(MealType::class)->create([
            'id' => 4,
            'name' => '汁物',
            'sort_no' => 4,
        ]);
        factory(MealType::class)->create([
            'id' => 5,
            'name' => 'デザート',
            'sort_no' => 5,
        ]);
        factory(MealType::class)->create([
            'id' => 6,
            'name' => 'その他',
            'sort_no' => 6,
        ]);
    }
}
