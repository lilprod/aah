<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('matricule')->nullable();
            $table->string('name');
            $table->string('firstname');
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->mediumText('address')->nullable();
            $table->char('gender',1)->nullable();
            $table->date('birth_date')->nullable();
            $table->string('place_birth')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('nationality')->nullable();
            $table->string('ethnic_group')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('rhesus')->nullable();
            $table->string('profession')->nullable();
            $table->string('profile_picture')->nullable();
            $table->integer('status');
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('country')->nullable();
            $table->integer('doctor_id')->nullable();
            $table->string('doctor_user_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->datetime('last_visit')->nullable();
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
        Schema::dropIfExists('patients');
    }
}
