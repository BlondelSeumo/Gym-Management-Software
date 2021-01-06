<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_branches', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('detail_id');
            $table->foreign('detail_id')
                ->references('id')
                ->on('common_details')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedInteger('area_id');
            $table->foreign('area_id')
                ->references('id')
                ->on('areas')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('owner_incharge_name');
            $table->text('address');
            $table->text('phone');
            $table->text('phone2');
            $table->decimal('longitude', 10, 8);
            $table->decimal('latitude', 10, 8);
            $table->enum('status', ['active', 'inactive'])
                ->default('active');
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
        Schema::drop('business_branches');
    }
}
