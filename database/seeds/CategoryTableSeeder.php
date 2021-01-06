<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->delete();

        $categories = [
            'Gym' => 'active',
            'Zumba' => 'active',
            'Aerobics' => 'active',
            'Yoga' => 'active',
            'Pilates' => 'active',
            'Martial arts & Kick Boxing' => 'active',
            'Swimming' => 'active',
        ];

        foreach ($categories as $category => $status) {
            Category::create([
                'name' => $category,
                'status' => $status
            ]);
        }
    }
}
