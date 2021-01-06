<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGymEmailCampaignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gym_email_campaign', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('merchant_id');
            $table->foreign('merchant_id')
                ->references('id')
                ->on('merchants')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedInteger('detail_id');
            $table->foreign('detail_id')
                ->references('id')
                ->on('common_details')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedInteger('template_id');
            $table->foreign('template_id')
                ->references('id')
                ->on('gym_email_campaign_template')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('campaign_name');
            $table->string('campaign_template');
            $table->string('email_title');
            $table->mediumText('email_content');
            $table->integer('no_of_emails');
            $table->dateTime('sent_on')
                ->nullable();
            $table->enum('status', ['draft', 'sent'])
                ->default('draft');
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
        Schema::drop('gym_email_campaign');
    }
}
