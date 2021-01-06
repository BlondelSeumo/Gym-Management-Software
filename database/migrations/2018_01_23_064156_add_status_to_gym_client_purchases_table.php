<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusToGymClientPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gym_client_purchases', function (Blueprint $table) {
            $table->enum('status', ['active', 'pending'])
                ->default('active')
                ->after('payment_required');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gym_client_purchases', function (Blueprint $table) {
            //
        });
    }
}
