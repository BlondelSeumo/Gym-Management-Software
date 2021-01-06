<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantCustomPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_custom_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('client_id');
            $table->foreign('client_id')
                ->references('id')
                ->on('gym_clients')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedInteger('type');
            $table->foreign('type')
                ->references('id')
                ->on('merchant_custom_payment_type')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('payment_id');
            $table->integer('amount');
            $table->enum('source', ['cash', 'credit_card', 'debit_card', 'net_banking'])
                ->default('cash');
            $table->date('payment_date');
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
        Schema::drop('merchant_custom_payments');
    }
}
