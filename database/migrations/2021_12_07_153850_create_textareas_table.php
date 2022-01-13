<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTextareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('textareas', function (Blueprint $table) {
            $table->id();
            $table->text('text', 1000);
            $table->unsignedBigInteger('section_title_id')->nullable();
            $table->foreign('section_title_id')->references('id')->on('section_titles')->onDelete('cascade');
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
        Schema::dropIfExists('textareas');
    }
}
