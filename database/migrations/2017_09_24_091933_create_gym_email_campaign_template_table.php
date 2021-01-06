<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGymEmailCampaignTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gym_email_campaign_template', function(Blueprint $table) {
            $table->increments('id');
            $table->string('template_name');
            $table->string('description');
            $table->string('image');
            $table->longText('html_template');
            $table->mediumText('preview_template');
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
        Schema::drop('gym_email_campaign_template');
    }
}
