<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFooterSettingCredentialsColumnToGymSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gym_settings', function (Blueprint $table) {
            $table->string('about')
                ->nullable()
                ->after('idle_time');
            $table->string('fb_url')
                ->nullable()
                ->after('about');
            $table->string('google_url')
                ->nullable()
                ->after('fb_url');
            $table->string('youtube_url')
                ->nullable()
                ->after('google_url');
            $table->string('contact_mail')
                ->nullable()
                ->after('youtube_url');
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
