<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeLongitudeLatitudePhone2NullableInBusinessBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE `business_branches` CHANGE `phone2` `phone2` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;');
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE `business_branches` CHANGE `longitude` `longitude` DECIMAL(10,8) NULL;');
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE `business_branches` CHANGE `latitude` `latitude` DECIMAL(10,8) NULL;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
