<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescribedDrugsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescribed_drugs', function (Blueprint $table) {
            $table->id();
            $table->integer('patient_id');
            $table->integer('patient_userid');
            $table->integer('doctor_id');
            $table->integer('doctor_userid');
            $table->integer('appointment_id');
            $table->integer('prescription_id');
            $table->integer('drugtype_id')->nullable();
            $table->integer('drug_id');
            $table->string('drug_name')->nullable();
            $table->integer('quantity');
            $table->integer('strength')->nullable();
            $table->string('dose');
            $table->string('duration');
            $table->mediumText('advice')->nullable();
            $table->boolean('morning')->default(0);
            $table->boolean('afternoon')->default(0);
            $table->boolean('evening')->default(0);
            $table->boolean('night')->default(0);
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
        Schema::dropIfExists('prescribed_drugs');
    }
}
