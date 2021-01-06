<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\TargetType;

class TargetTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = Category::first();
        $types = ['subscription', 'revenue'];

        foreach ($types as $type) {
            TargetType::create([
                'category_id' => $category->id,
                'type' => $type
            ]);
        }
    }
}
