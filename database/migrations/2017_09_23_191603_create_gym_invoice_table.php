<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGymInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gym_invoice', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('merchant_id');
            $table->foreign('merchant_id')
                ->references('id')
                ->on('merchants')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedInteger('detail_id');
            $table->foreign('detail_id')
                ->references('id')
                ->on('common_details')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('invoice_number');
            $table->string('client_name');
            $table->text('client_address');
            $table->string('email')
                ->nullable();
            $table->string('mobile')
                ->nullable();
            $table->date('invoice_date');
            $table->string('sub_total');
            $table->string('discount_amount');
            $table->string('tax_percent')
                ->nullable();
            $table->string('sgst')
                ->nullable();
            $table->string('cgst')
                ->nullable();
            $table->string('igst')
                ->nullable();
            $table->string('sgst_amount')
                ->nullable();
            $table->string('cgst_amount')
                ->nullable();
            $table->string('igst_amount')
                ->nullable();
            $table->string('total');
            $table->string('generated_by');
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
        Schema::drop('gym_invoice');
    }
}
