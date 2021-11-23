<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->longText('invoice')->nullable();
            $table->string('beneficiary_name')->nullable();
            $table->string('code_bank')->nullable();
            $table->string('number_agency')->nullable();
            $table->string('number_account')->nullable();
            $table->unsignedDouble('value_payment',6,2)->nullable();
            $table->string('status')->default('CRIADO');
            $table->string('bank_processor')->nullable();
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
        Schema::dropIfExists('payments');
    }
}
