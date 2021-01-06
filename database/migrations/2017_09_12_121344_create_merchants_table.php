<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 150);
            $table->string('password', 150);
            $table->unsignedInteger('detail_id')
                ->nullable();
            $table->foreign('detail_id')
                ->references('id')
                ->on('common_details')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('image', 255)
                ->nullable();
            $table->string('first_name', 100);
            $table->string('last_name', 100)
                ->nullable();
            $table->enum('gender', ['male', 'female'])
                ->default('male');
            $table->string('mobile', 15);
            $table->string('email', 150);
            $table->date('date_of_birth')
                ->nullable();
            $table->date('trial_start_date')
                ->nullable();
            $table->date('trial_end_date')
                ->nullable();
            $table->dateTime('last_login')
                ->nullable();
            $table->dateTime('last_activity')
                ->nullable();
            $table->dateTime('agree_terms')
                ->nullable();
            $table->string('remember_token', 150)
                ->nullable();
            $table->string('reset_password_token', 150)
                ->nullable();
            $table->boolean('send_sms')
                ->default('1');
            $table->boolean('send_mail')
                ->default('1');
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
        Schema::drop('merchants');
    }
}
