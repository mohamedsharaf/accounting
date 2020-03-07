<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->uuid('parent_id')->index()->nullable();

            $table->uuid('company_id')->index();
            $table->uuid('branch_id')->index();//
            $table->uuid('currency_id')->index();

            $table->json('name');
            $table->string('code')->unique();

            $table->text('description')->nullable();
            $table->text('notes')->nullable();

            //todo use enum
            $table->tinyInteger('natural'); // D =1 & C =0
            $table->tinyInteger('freeze')->default(0);
            $table->tinyInteger('final')->default(0);
            $table->integer('level')->nullable();


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
        Schema::dropIfExists('accounts');
    }
}
