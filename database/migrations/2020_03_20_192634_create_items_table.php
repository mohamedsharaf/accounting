<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('items', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('company_id')->index();
            $table->uuid('branch_id')->index();
            // $table->uuid('currency_id')->index();

            $table->string('title');
            $table->string('img')->nullable();
            $table->integer('quantity')->default(0);
            $table->integer('price')->default(0);
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
        Schema::dropIfExists('items');
    }
}
