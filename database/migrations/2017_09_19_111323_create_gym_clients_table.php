<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGymClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gym_clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->date('dob');
            $table->enum('gender', ['male', 'female']);
            $table->string('email', 50);
            $table->longText('address')
                ->nullable();
            $table->string('mobile', 15);
            $table->integer('age');
            $table->date('joining_date')
                ->nullable();
            $table->double('weight', 8, 2);
            $table->tinyInteger('height_feet');
            $table->tinyInteger('height_inches');
            $table->string('image', 255)
                ->nullable();
            $table->enum('client_source', ['huntplex', 'direct']);
            $table->enum('marital_status', ['yes', 'no'])
                ->default('no');
            $table->date('anniversary')
                ->nullable();
            $table->unsignedInteger('detail_id');
            $table->foreign('detail_id')
                ->references('id')
                ->on('common_details')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedInteger('branch_id')
                ->nullable();
            $table->foreign('branch_id')
                ->references('id')
                ->on('business_branches')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->softDeletes();
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
        Schema::drop('gym_clients');
    }
}
