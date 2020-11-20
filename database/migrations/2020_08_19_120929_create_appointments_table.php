<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->time('begin_time');
            $table->time('end_time')->nullable();
            $table->date('date_apt');
            $table->integer('schedule_id');
            $table->float('apt_amount')->nullable();
            $table->integer('speciality_id')->nullable();
            $table->integer('patient_id');
            $table->integer('doctor_id');
            $table->integer('doctor_user_id');
            $table->integer('patient_user_id');
            $table->mediumText('note')->nullable();
            $table->date('confirm_date')->nullable();
            $table->string('identifier')->nullable();
            $table->integer('paymentmode_id')->nullable();
            $table->integer('status');

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
        Schema::dropIfExists('appointments');
    }
}
