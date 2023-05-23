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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('language');
            $table->string('publication_type');
            $table->string('image')->nullable();
            $table->string('title');
            $table->string('description');
            $table->string('heading');
            $table->string('tags');
            $table->integer('site_location');
            $table->string('link')->nullable();
            $table->text('content');
            $table->string('author_comment')->nullable();
            $table->integer('user_id')->index()->unsigned();
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
        Schema::dropIfExists('posts');
    }
};
