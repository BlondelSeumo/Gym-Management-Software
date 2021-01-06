<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGymMerchantRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gym_merchant_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('detail_id');
            $table->foreign('detail_id')
                ->references('id')
                ->on('common_details')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('name', 255);
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
        Schema::drop('gym_merchant_roles');
    }
}
