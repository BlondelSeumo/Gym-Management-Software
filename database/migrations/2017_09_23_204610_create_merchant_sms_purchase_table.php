<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantSmsPurchaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_sms_purchase', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('merchant_id');
            $table->foreign('merchant_id')
                ->references('id')
                ->on('merchants')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('credit_purchased');
            $table->double('cost_per_credit', 8, 2);
            $table->double('grand_total', 8, 2);
            $table->double('tax_percent', 8, 2);
            $table->double('sub_total', 8, 2);
            $table->string('payment_id');
            $table->string('payment_gateway');
            $table->string('admin_note');
            $table->enum('status', ['pending', 'credited', 'queued', 'rejected'])
                ->default('pending');
            $table->softDeletes();
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
        Schema::drop('merchant_sms_purchase');
    }
}
