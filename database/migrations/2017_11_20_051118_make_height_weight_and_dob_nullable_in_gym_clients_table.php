<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeHeightWeightAndDobNullableInGymClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE `gym_clients` CHANGE `dob` `dob` DATE NULL;');
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE `gym_clients` CHANGE `height_feet` `height_feet` TINYINT(4) NULL;');
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE `gym_clients` CHANGE `height_inches` `height_inches` TINYINT(4) NULL;');
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE `gym_clients` CHANGE `weight` `weight` DOUBLE(8,2) NULL;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
