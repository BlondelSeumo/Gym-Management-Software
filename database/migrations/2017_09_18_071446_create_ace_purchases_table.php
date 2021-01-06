<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ace_purchases', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('detail_id');
            $table->foreign('detail_id')
                ->references('id')
                ->on('common_details')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedInteger('plan_id');
            $table->foreign('plan_id')
                ->references('id')
                ->on('ace_plans')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->double('sub_total', 8, 2);
            $table->double('discount', 8, 2)
                ->nullable();
            $table->tinyInteger('tax_percent');
            $table->double('grand_total', 8, 2);
            $table->string('purchase_id', 255);
            $table->string('payment_gateway', 255)
                ->nullable();
            $table->string('transaction_id', 255)
                ->nullable();
            $table->string('payment_method', 255);
            $table->enum('status', ['yes', 'no']);
            $table->date('plan_starts_on');
            $table->date('plan_expires_on');
            $table->enum('plan_status', ['active', 'expired']);
            $table->text('remark');
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
        Schema::drop('ace_purchases');
    }
}
