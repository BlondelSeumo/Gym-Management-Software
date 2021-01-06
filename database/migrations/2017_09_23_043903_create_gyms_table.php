<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGymsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gyms', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('detail_id');
            $table->foreign('detail_id')
                ->references('id')
                ->on('common_details')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->tinyInteger('spa_hot_tub');
            $table->tinyInteger('sauna_steam_bath');
            $table->tinyInteger('massage');
            $table->tinyInteger('therapies');
            $table->tinyInteger('cardio');
            $table->tinyInteger('aerobics');
            $table->tinyInteger('yoga');
            $table->tinyInteger('air_conditioned');
            $table->tinyInteger('towel_service');
            $table->tinyInteger('shower');
            $table->tinyInteger('lokers');
            $table->tinyInteger('juice_bar');
            $table->tinyInteger('free_trial');
            $table->tinyInteger('free_trial_days')
                ->nullable();
            $table->tinyInteger('dietician_nutrition');
            $table->tinyInteger('physiotherapist');
            $table->tinyInteger('personal_trainer');
            $table->tinyInteger('trade_mill');
            $table->tinyInteger('leg_equipment');
            $table->tinyInteger('exercise_bike');
            $table->tinyInteger('thigh_equipment');
            $table->tinyInteger('bisceps_trainer');
            $table->tinyInteger('wrist_forearms');
            $table->tinyInteger('abdomen_abs');
            $table->tinyInteger('back_shoulder');
            $table->enum('type', ['gym', 'fitness', 'both']);
            $table->tinyInteger('special_ladies_batch');
            $table->integer('gym_monthly_price')
                ->nullable();
            $table->integer('gym_quarterly_price')
                ->nullable();
            $table->integer('gym_halfyearly_price')
                ->nullable();
            $table->integer('gym_yearly_price')
                ->nullable();
            $table->integer('fitness_monthly_price')
                ->nullable();
            $table->integer('fitness_quarterly_price')
                ->nullable();
            $table->integer('fitness_halfyearly_price')
                ->nullable();
            $table->integer('fitness_yearly_price')
                ->nullable();
            $table->enum('gender', ['male', 'female', 'both']);
            $table->string('morning_open_time')
                ->nullable();
            $table->string('morning_close_time')
                ->nullable();
            $table->string('evening_open_time')
                ->nullable();
            $table->string('evening_close_time')
                ->nullable();
            $table->tinyInteger('sat_closed');
            $table->tinyInteger('sun_closed');
            $table->integer('cash');
            $table->integer('credit_card');
            $table->integer('debit_card');
            $table->text('zumba_data')
                ->nullable();
            $table->text('aerobics_data')
                ->nullable();
            $table->text('yoga_data')
                ->nullable();
            $table->text('pilate_data')
                ->nullable();
            $table->text('swim_data')
                ->nullable();
            $table->text('martial_art_data')
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
        Schema::drop('gyms');
    }
}
