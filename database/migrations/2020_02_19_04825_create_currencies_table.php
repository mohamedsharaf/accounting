<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->uuid('company_id')->index();
//            $table->uuid('branch_id')->index();

            $table->json('name');
            $table->string('code');
            $table->double('rate', 15, 8)->default(1);
            $table->string('precision')->nullable();
            $table->string('symbol')->nullable();
            $table->integer('symbol_first')->default(1);
            $table->string('decimal_mark')->nullable();
            $table->string('thousands_separator')->nullable();

            $table->tinyInteger('enabled')->default(1);


            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currencies');
    }
}
