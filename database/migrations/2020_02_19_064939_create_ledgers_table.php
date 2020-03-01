<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLedgersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ledgers', function (Blueprint $table) {


            $table->uuid('id')->primary();
            $table->uuid('company_id');
            $table->uuid('account_id');

            $table->string('ledgerable_type');
            $table->uuid('ledgerable_id');
            $table->index(['ledgerable_type', 'ledgerable_id']);

            $table->dateTime('issued_at');

            $table->string('entry_type');
            $table->double('debit', 15, 4)->nullable();
            $table->double('credit', 15, 4)->nullable();

            $table->double('amount', 15, 4)->nullable();
            $table->double('amount_foreign', 15, 4)->nullable();

            $table->double('foreign_rate')->default(1);

            $table->string('reference')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index('company_id');
            $table->index('account_id');
            $table->index('issued_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ledgers');
    }
}
