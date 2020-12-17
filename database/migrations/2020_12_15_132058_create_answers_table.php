<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->integer('review_id');
            $table->mediumText('body');
            $table->integer('user_id')->unsigned();
            $table->integer('parent_id')->nullable();
            $table->integer('patient_id')->nullable();
            $table->integer('doctor_id')->nullable();
            $table->integer('doctor_user_id')->nullable();
            $table->integer('answerable_id')->unsigned();
            $table->string('answerable_type');
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
        Schema::dropIfExists('answers');
    }
}
