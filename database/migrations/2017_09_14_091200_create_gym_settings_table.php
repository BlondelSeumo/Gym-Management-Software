<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGymSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gym_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('detail_id');
            $table->foreign('detail_id')
                ->references('id')
                ->on('common_details')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('mobile', 255);
            $table->string('image', 255);
            $table->string('address', 255);
            $table->string('gstin', 255)
                ->nullable();
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
        Schema::drop('gym_settings');
    }
}
