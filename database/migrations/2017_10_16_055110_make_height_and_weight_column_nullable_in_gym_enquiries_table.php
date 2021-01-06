<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class MakeHeightAndWeightColumnNullableInGymEnquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE `gym_enquiries` CHANGE `height_feet` `height_feet` TINYINT(4) NULL;');
        DB::statement('ALTER TABLE `gym_enquiries` CHANGE `height_inches` `height_inches` TINYINT(4) NULL;');
        DB::statement('ALTER TABLE `gym_enquiries` CHANGE `weight` `weight` TINYINT(4) NULL;');
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
