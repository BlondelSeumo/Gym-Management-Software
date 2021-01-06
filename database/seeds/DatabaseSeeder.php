<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CountryTableSeeder::class);
        $this->call(StatesTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(GymPermissionTableSeeder::class);
        $this->call(TargetTypeTableSeeder::class);
        $this->call(GymEmailTemplateTableSeeder::class);
        $this->call(GymTutorialTableSeeder::class);
        $this->call(SoftwareUpdateTableSeeder::class);
        $this->call(MerchantTableSeeder::class);
    }
}
