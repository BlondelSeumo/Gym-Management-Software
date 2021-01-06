<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFrontImageToGymSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE `gym_settings` DROP `address`;');
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE `gym_settings` DROP `mobile`;');
        Schema::table('gym_settings', function (Blueprint $table) {
            $table->string('front_image')
                ->after('image')
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gym_settings', function (Blueprint $table) {
            //
        });
    }
}
