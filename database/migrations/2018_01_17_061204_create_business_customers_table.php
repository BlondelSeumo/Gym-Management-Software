<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gym_clients', function (Blueprint $table) {
            $table->dropForeign(['detail_id']);
            $table->dropForeign(['branch_id']);
            $table->dropColumn('detail_id');
            $table->dropColumn('branch_id');
        });

        Schema::create('business_customers', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('detail_id');
            $table->foreign('detail_id')
                ->references('id')
                ->on('common_details')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedInteger('customer_id');
            $table->foreign('customer_id')
                ->references('id')
                ->on('gym_clients')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::drop('business_customers');
    }
}
