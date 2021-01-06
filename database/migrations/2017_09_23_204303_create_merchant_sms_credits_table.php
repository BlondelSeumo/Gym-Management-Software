<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantSmsCreditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_sms_credits', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('merchant_id');
            $table->foreign('merchant_id')
                ->references('id')
                ->on('merchants')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('credit_balance');
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
        Schema::drop('merchant_sms_credits');
    }
}
