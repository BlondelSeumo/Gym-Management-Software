<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGymMembershipPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gym_membership_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('gym_clients')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedInteger('purchase_id')
                ->nullable();
            $table->foreign('purchase_id')
                ->references('id')
                ->on('gym_client_purchases')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedInteger('detail_id');
            $table->foreign('detail_id')
                ->references('id')
                ->on('common_details')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedInteger('payment_type')
                ->nullable();
            $table->foreign('payment_type')
                ->references('id')
                ->on('merchant_custom_payment_type')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('payment_id');
            $table->integer('payment_amount');
            $table->enum('payment_source', ['cash', 'credit_card', 'debit_card', 'net_banking']);
            $table->dateTime('payment_date');
            $table->string('remarks')
                ->nullable();
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
        Schema::drop('gym_membership_payments');
    }
}
