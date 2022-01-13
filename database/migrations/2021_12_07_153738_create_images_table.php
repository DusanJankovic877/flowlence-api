<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('path');
            $table->unsignedBigInteger('section_title_id')->nullable();
            $table->foreign('section_title_id')->references('id')->on('section_titles')->onDelete('cascade');
            $table->timestamps();
        });
        // Schema::table('proforms', function (Blueprint $table) {
        //     $table->foreign('proform_id')
        //           ->references('id')
        //           ->on('proforms')
        //           ->onDelete('cascade');            
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }
}
