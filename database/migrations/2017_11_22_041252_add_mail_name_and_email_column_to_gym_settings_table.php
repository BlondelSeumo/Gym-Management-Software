<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMailNameAndEmailColumnToGymSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gym_settings', function (Blueprint $table) {
            $table->string('mail_name')
                ->after('mail_encryption')
                ->nullable();
            $table->string('mail_email')
                ->after('mail_name')
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
