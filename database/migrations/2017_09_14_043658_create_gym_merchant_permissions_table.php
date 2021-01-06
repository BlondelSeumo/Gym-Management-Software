<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGymMerchantPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gym_merchant_permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('display_name', 255)
                ->nullable();
            $table->string('description', 255)
                ->nullable();
            $table->string('for', 50)
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
        Schema::drop('gym_merchant_permissions');
    }
}
