<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThreadMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_threads', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('customer_id');
            $table->foreign('customer_id')
                ->references('id')
                ->on('gym_clients')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedInteger('merchant_id');
            $table->foreign('merchant_id')
                ->references('id')
                ->on('merchants')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedInteger('detail_id');
            $table->foreign('detail_id')
                ->references('id')
                ->on('common_details')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('messages', function (Blueprint $table) {
            $table->unsignedInteger('thread_id')
                ->after('id');
            $table->foreign('thread_id')
                ->references('id')
                ->on('message_threads')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign(['thread_id']);
            $table->dropColumn('thread_id');
        });

        Schema::drop('message_threads');
    }
}
