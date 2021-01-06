<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGymEnquiriesFollowUpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gym_enquiries_follow_up', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('gym_enquiry_id');
            $table->foreign('gym_enquiry_id')
                ->references('id')
                ->on('gym_enquiries')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('packages_offered', 50);
            $table->text('remark')
                ->nullable();
            $table->string('package_amount', 10)
                ->nullable();
            $table->string('counselor_name', 50);
            $table->date('follow_up_date');
            $table->date('next_follow_up_on');
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
        Schema::drop('gym_enquiries_follow_up');
    }
}
