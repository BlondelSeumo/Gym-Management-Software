<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGymPackageMembershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gym_package_memberships', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('package_id');
            $table->foreign('package_id')
                ->references('id')
                ->on('gym_packages')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedInteger('membership_id');
            $table->foreign('membership_id')
                ->references('id')
                ->on('gym_memberships')
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
        Schema::drop('gym_package_memberships');
    }
}
