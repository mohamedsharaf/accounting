<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJournalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journals', function (Blueprint $table) {

            $table->uuid('id')->index();
            $table->bigInteger('number')->autoIncrement();

            $table->uuid('company_id');
            $table->uuid('branch_id');

            $table->double('amount', 15, 4);//total
            $table->date('paid_at'); //date

            $table->text('description')->nullable();
            $table->string('reference')->nullable();

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
        Schema::dropIfExists('journals');
    }
}
