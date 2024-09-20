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
            $table->string('token')->nullable();
            $table->integer('user_id', false);
            $table->integer('transaction_id', false)->nullable();
            $table->string('ref_no', false)->nullable();
            $table->string('type');
            $table->string('items')->nullable();
            $table->string('currency');
            $table->double('amount');
            $table->string('payment_method')->nullable();
            $table->boolean('paid')->nullable();
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
