<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddBusinessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_business', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name', 150);
            $table->string('email', 150);
            $table->string('mobile', 20);
            $table->string('business_name', 150);
            $table->string('business_location', 100);
            $table->enum('status', ['pending', 'inprocess', 'completed', 'wrong info']);
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
        Schema::drop('add_business');
    }
}
