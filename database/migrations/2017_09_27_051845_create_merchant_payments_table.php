<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_payments', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('detail_id');
            $table->foreign('detail_id')
                ->references('id')
                ->on('common_details')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('original_amount', 15);
            $table->string('paid_amount', 15);
            $table->string('amount_received_by_customer', 15);
            $table->date('paid_on')
                ->nullable();
            $table->string('transaction_id', 50)
                ->nullable();
            $table->string('profit', 50)
                ->nullable();
            $table->string('loss', 50)
                ->nullable();
            $table->date('payment_from');
            $table->date('payment_to');
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
        Schema::drop('merchant_payments');
    }
}
