<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ace_plans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('plan_name', 255);
            $table->unsignedInteger('category_id');
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->double('plan_price', 8, 2);
            $table->double('discount', 8, 2)
                ->nullable();
            $table->date('discount_ends_on')
                ->nullable();
            $table->enum('show_discount_timer', ['yes', 'no'])
                ->default('no');
            $table->integer('plan_duration_days');
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
        Schema::drop('ace_plans');
    }
}
