<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessEnquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_enquiries', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('detail_id');
            $table->foreign('detail_id')
                ->references('id')
                ->on('common_details')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('username');
            $table->string('email');
            $table->string('phone');
            $table->string('query');
            $table->enum('status', ['pending', 'in_process', 'resolved']);
            $table->enum('title', ['mr', 'mrs', 'miss'])
                ->default('mr');
            $table->string('last_name');
            $table->dateTime('birthday');
            $table->dateTime('anniversary');
            $table->integer('age');
            $table->enum('gender', ['male', 'female'])
                ->default('male');
            $table->enum('marital_status', ['married', 'single'])
                ->default('single');
            $table->string('occupation');
            $table->string('address');
            $table->string('location');
            $table->string('city');
            $table->string('state');
            $table->string('postal_code');
            $table->enum('enquire_mode', ['walk_in', 'telephonic', 'huntplex'])
                ->default('walk_in');
            $table->enum('cometo_know', ['advertisement', 'tvcable', 'onlinead', 'justdial', 'newspaper', 'others', 'friends'])
                ->default('others');
            $table->string('referred_by');
            $table->dateTime('followup_on')
                ->nullable();
            $table->enum('priority', ['low', 'medium', 'high']);
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
        Schema::drop('business_enquiries');
    }
}
