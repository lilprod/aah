<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExaminationFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examination_files', function (Blueprint $table) {
            $table->id();
            $table->integer('patient_id');
            $table->integer('patient_userid');
            $table->integer('doctor_id');
            $table->integer('doctor_userid');
            $table->integer('prescription_id');
            $table->string('file');
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
        Schema::dropIfExists('examination_files');
    }
}
