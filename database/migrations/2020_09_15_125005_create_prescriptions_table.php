<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();
            $table->integer('prescriptionType_id');
            $table->integer('patient_id');
            $table->integer('patient_userid');
            $table->integer('doctor_id');
            $table->integer('doctor_userid');
            $table->integer('appointment_id');
            $table->mediumText('chief_complains')->nullable();
            $table->mediumText('on_examinations')->nullable();
            $table->mediumText('provisional_diagnosis')->nullable();
            $table->mediumText('differential_diagnosis')->nullable();
            $table->mediumText('lab_workup')->nullable();
            $table->mediumText('advices')->nullable();
            $table->mediumText('reason')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('pulse')->nullable();
            $table->string('blood_pressure')->nullable();
            $table->integer('quantity_med')->nullable();
            $table->date('next_visit')->nullable();
            $table->string('identifier')->nullable();
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
        Schema::dropIfExists('prescriptions');
    }
}
