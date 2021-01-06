<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_management', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('merchant_id')->unsigned();
            $table->foreign('merchant_id')
                ->references('id')
                ->on('merchants')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('heading', 100);
            $table->text('description')->nullable();
            $table->date('deadline')->nullable();
            $table->date('reminder_date')->nullable();
            $table->enum('status', ['pending', 'complete'])->default('pending');
            $table->enum('priority', ['low', 'medium', 'high'])->default('low');
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
        Schema::drop('task_management');
    }
}
