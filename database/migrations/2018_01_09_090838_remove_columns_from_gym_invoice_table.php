<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class RemoveColumnsFromGymInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE `gym_invoice` DROP `tax_percent`;');
        DB::statement('ALTER TABLE `gym_invoice` DROP `sgst`;');
        DB::statement('ALTER TABLE `gym_invoice` DROP `cgst`;');
        DB::statement('ALTER TABLE `gym_invoice` DROP `igst`;');
        DB::statement('ALTER TABLE `gym_invoice` DROP `sgst_amount`;');
        DB::statement('ALTER TABLE `gym_invoice` DROP `cgst_amount`;');
        DB::statement('ALTER TABLE `gym_invoice` DROP `igst_amount`;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
