<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommonDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('common_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('city_id')
                ->nullable();
            $table->foreign('city_id')
                ->references('id')
                ->on('cities')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedInteger('area_id')
                ->nullable();
            $table->foreign('area_id')
                ->references('id')
                ->on('areas')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('title', 200);
            $table->text('address');
            $table->decimal('longitude', 10, 8)
                ->nullable();
            $table->decimal('latitude', 10, 8)
                ->nullable();
            $table->string('slug', 250);
            $table->string('owner_incharge_name', 150);
            $table->text('phone');
            $table->string('owner_incharge_name2', 150)
                ->nullable();
            $table->text('phone2')
                ->nullable();
            $table->string('email', 150);
            $table->string('bitly_link', 100)
                ->nullable();
            $table->string('search_title', 200);
            $table->enum('status', ['active', 'inactive', 'pending'])
                ->default('active');
            $table->dateTime('last_updated')
                ->nullable();
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
        Schema::drop('common_details');
    }
}
