<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGymInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gym_invoice_items', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('invoice_id');
            $table->foreign('invoice_id')
                ->references('id')
                ->on('gym_invoice')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('item_name');
            $table->integer('quantity');
            $table->string('cost_per_item');
            $table->string('amount');
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
        Schema::drop('gym_invoice_items');
    }
}
