<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGymEnquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gym_enquiries', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('detail_id');
            $table->foreign('detail_id')
                ->references('id')
                ->on('common_details')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->date('enquiry_date');
            $table->string('customer_name');
            $table->text('address')
                ->nullable();
            $table->string('mobile', 15);
            $table->string('email', 50);
            $table->tinyInteger('age');
            $table->tinyInteger('height_feet');
            $table->tinyInteger('height_inches');
            $table->tinyInteger('weight');
            $table->date('dob');
            $table->enum('sex', ['male', 'female']);
            $table->string('occupation', 20);
            $table->string('come_to_know', 50);
            $table->string('customer_goal', 50);
            $table->string('weight_loss_amount', 20);
            $table->string('weight_gain_amount', 20);
            $table->enum('exercise_regularly', ['yes', 'no']);
            $table->string('exercise_type', 30);
            $table->string('gyming_where', 20)
                ->nullable();
            $table->string('gyming_since', 20)
                ->nullable();
            $table->date('previous_follow_up');
            $table->date('next_follow_up');
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
        Schema::drop('gym_enquiries');
    }
}
