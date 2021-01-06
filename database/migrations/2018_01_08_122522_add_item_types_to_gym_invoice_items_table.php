<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddItemTypesToGymInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gym_invoice_items', function (Blueprint $table) {
            $table->enum('item_type', ['item', 'tax', 'discount'])
                ->after('invoice_id')
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gym_invoice_items', function (Blueprint $table) {
            //
        });
    }
}
