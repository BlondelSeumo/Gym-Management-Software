<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpenseManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expense_management', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('detail_id');
            $table->foreign('detail_id')
                ->references('id')
                ->on('common_details')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('item_name', 50);
            $table->date('purchase_date');
            $table->string('purchase_from', 50)->nullable();
            $table->double('price', 15, 8);
            $table->string('bill', 100)->nullable();
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
        Schema::drop('expense_management');
    }
}
