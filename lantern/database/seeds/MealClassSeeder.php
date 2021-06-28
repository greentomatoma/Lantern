<?php

use Illuminate\Database\Seeder;
use App\Models\MealClass;

class MealClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(MealClass::class)->create([
            'id' => 1,
            'name' => '容易にかめる',
            'sort_no' => 1,
        ]);
        factory(MealClass::class)->create([
            'id' => 2,
            'name' => '歯ぐきでつぶせる',
            'sort_no' => 2,
        ]);
        factory(MealClass::class)->create([
            'id' => 3,
            'name' => '舌でつぶせる',
            'sort_no' => 3,
        ]);
        factory(MealClass::class)->create([
            'id' => 4,
            'name' => 'かまなくてよい',
            'sort_no' => 4,
        ]);
    }
}
