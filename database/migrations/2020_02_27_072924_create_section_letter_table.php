<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionLetterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_letter', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('section_id')->index();
            $table->uuid('letter_id')->index();
            // $table->unsignedBigInteger('section_id');
            // $table->unsignedBigInteger('letter_id');
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
        Schema::dropIfExists('section_letter');
    }
}
