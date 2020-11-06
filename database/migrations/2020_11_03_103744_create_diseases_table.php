<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiseasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diseases', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('scientific_name')->nullable();
            $table->string('slug')->nullable();
            $table->mediumText('description')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('attach_file')->nullable();
            $table->mediumText('video_url')->nullable();
            $table->longText('treatment')->nullable();
            $table->integer('user_id')->nullable();
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('diseases');
    }
}
