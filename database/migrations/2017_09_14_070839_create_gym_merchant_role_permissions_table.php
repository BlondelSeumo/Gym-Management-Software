<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGymMerchantRolePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gym_merchant_role_permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('permission_id');
            $table->foreign('permission_id')
                ->references('id')
                ->on('gym_merchant_permissions')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedInteger('role_id');
            $table->foreign('role_id')
                ->references('id')
                ->on('gym_merchant_roles')
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
        Schema::drop('gym_merchant_role_permissions');
    }
}
