<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('cache_status', ['on', 'off'])
                ->default('off');
            $table->enum('under_development', ['on', 'off'])
                ->default('on');
            $table->string('logo', 100);
            $table->string('fb_url', 200);
            $table->string('twitter_url', 200);
            $table->string('google_plus_url', 200);
            $table->text('contact_no');
            $table->text('address');
            $table->text('fb_app_id');
            $table->text('fb_secret_key');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('site_settings');
    }
}
