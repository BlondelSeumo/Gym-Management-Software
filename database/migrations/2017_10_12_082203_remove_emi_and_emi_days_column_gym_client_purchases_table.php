<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveEmiAndEmiDaysColumnGymClientPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE `gym_client_purchases` DROP `emi`;');
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE `gym_client_purchases` DROP `emi_days`;');
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
