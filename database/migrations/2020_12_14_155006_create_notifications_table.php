<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->mediumText('message')->nullable();
            $table->datetime('reception_date')->nullable();
            $table->integer('sender_id')->nullable();
            $table->integer('receiver_id')->nullable();
            $table->string('notif_id')->nullable();
            $table->string('object')->nullable();
            $table->integer('object_id')->nullable();
            $table->string('route')->nullable();
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('notifications');
    }
}
