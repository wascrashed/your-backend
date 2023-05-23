<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posters', function (Blueprint $table) {
            $table->id();
            $table->datetime('start');
            $table->datetime('finish');
            $table->integer('cost')->nullable();
            $table->string('image')->nullable();
            $table->string('title');
            $table->string('address');
            $table->string('link')->nullable();
            $table->string('description');
            $table->boolean('free')->nullable();
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
        Schema::dropIfExists('posters');
    }
};
