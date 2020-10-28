<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->integer('doctor_id');
            $table->integer('doctor_userid');
            $table->integer('day_num');
            $table->string('day')->nullable();
            $table->time('begin_time');
            $table->time('end_time'); 
            $table->integer('status')->nullable();
            /*$table->boolean('isAvailableOnFriday');
            $table->string('fridayStartingTime')->nullable();
            $table->string('fridayClosingTime')->nullable();

            $table->boolean('isAvailableOnSaturday');
            $table->string('saturdayStartingTime')->nullable();
            $table->string('saturdayClosingTime')->nullable();

            $table->boolean('isAvailableOnSunday');
            $table->string('sundayStartingTime')->nullable();
            $table->string('sundayClosingTime')->nullable();

            $table->boolean('isAvailableOnMonday');
            $table->string('mondayStartingTime')->nullable();
            $table->string('mondayClosingTime')->nullable();

            $table->boolean('isAvailableOnTuesday');
            $table->string('tuesdayStartingTime')->nullable();
            $table->string('tuesdayClosingTime')->nullable();

            $table->boolean('isAvailableOnWednesday');
            $table->string('wednesdayStartingTime')->nullable();
            $table->string('wednesdayClosingTime')->nullable();

            $table->boolean('isAvailableOnThursday');
            $table->string('thursdayStartingTime')->nullable();
            $table->string('thursdayClosingTime')->nullable();*/
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
        Schema::dropIfExists('schedules');
    }
}
