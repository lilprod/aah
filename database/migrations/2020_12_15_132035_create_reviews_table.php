<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->mediumText('body')->nullable();
            $table->integer('rating')->nullable();
            $table->integer('patient_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('doctor_id')->nullable();
            $table->integer('doctor_user_id')->nullable();
            $table->char('recommend',1)->nullable();
            $table->boolean('approuved')->default(true);
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
        Schema::dropIfExists('reviews');
    }
}
