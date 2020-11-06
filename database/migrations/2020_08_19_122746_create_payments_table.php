<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer('apt_id');
            $table->integer('paymentmode_id')->nullable();
            $table->string('title')->nullable();
            $table->string('recurring_id')->nullable();
            $table->float('apt_amount');
            $table->string('description')->nullable();
            $table->integer('doctor_id');
            $table->integer('patient_id');
            $table->integer('doctor_user_id');
            $table->integer('patient_user_id');
            $table->string('tx_reference')->nullable();
            $table->dateTime('date_payment')->nullable();
            $table->integer('telephone')->nullable();
            $table->string('identifier')->nullable();
            $table->string('payment_status')->nullable();
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
        Schema::dropIfExists('payments');
    }
}
