<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GymClientPurchases extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gym_client_purchases', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('client_id');
            $table->foreign('client_id')
                ->references('id')
                ->on('gym_clients')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedInteger('membership_id')
                ->nullable();
            $table->foreign('membership_id')
                ->references('id')
                ->on('gym_memberships')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedInteger('detail_id');
            $table->foreign('detail_id')
                ->references('id')
                ->on('common_details')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->integer('purchase_amount');
            $table->integer('paid_amount');
            $table->integer('discount');
            $table->integer('emi');
            $table->integer('emi_days');
            $table->date('purchase_date');
            $table->date('start_date');
            $table->date('next_payment_date')
                ->nullable();
            $table->date('expires_on')
                ->nullable();
            $table->string('remarks')
                ->nullable();
            $table->integer('amount_to_be_paid');
            $table->enum('payment_required', ['yes', 'no'])
                ->default('yes');
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
        Schema::drop('gym_client_purchases');
    }
}
