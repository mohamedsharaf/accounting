<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('receipts', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('company_id')->index();
            $table->uuid('branch_id')->index();
            $table->uuid('currency_id')->index();
            $table->unsignedBigInteger('user_id');
            
            $table->uuid('client_id')->index();
            $table->string('barcode')->nullable();
            $table->string('discount')->nullable();
            $table->string('tax')->nullable();
            $table->string('total_payable')->nullable();
            $table->string('total_payed')->nullable();

            $table->string('payment_type')->default('none'); // none/cash/card
            $table->string('status')->default('draft'); // payed/draft
            
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
        Schema::dropIfExists('receipts');
    }
}
