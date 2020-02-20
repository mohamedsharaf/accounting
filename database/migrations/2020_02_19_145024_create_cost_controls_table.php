<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCostControlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cost_controls', function (Blueprint $table) {

                $table->uuid('id')->primary();

                $table->uuid('company_id');
                $table->uuid('branch_id');

            $table->json('name');


                $table->text('description')->nullable();

                $table->timestamps();
                $table->softDeletes();

                $table->index('company_id');
                $table->index('branch_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cost_controls');
    }
}
