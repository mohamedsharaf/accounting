<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            // $table->bigIncrements('id');
            // $table->unsignedInteger('company_id');
            $table->uuid('id')->primary();
            $table->uuid('company_id')->index();
            $table->uuid('section_id')->index()->nullable();
            $table->string('iqama_number');
            $table->string('name');
            $table->string('gender');
            $table->string('nationality');
            $table->string('occupation');
            $table->string('passport_number');
            $table->datetime('passport_expiry_date_hijri')->nullable();
            $table->datetime('passport_expiry_date_gregorian')->nullable();
            $table->datetime('iqama_expiry_date_hijri')->nullable();
            $table->datetime('iqama_expiry_date_gregorian')->nullable();
            $table->boolean('insurance_status')->default(0);
            $table->datetime('insurance_expiry')->nullable();

            $table->string('status')->default('valid');
            $table->boolean('trash')->default(0);

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
        Schema::dropIfExists('employees');
    }
}
