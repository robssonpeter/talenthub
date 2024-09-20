<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable("interviews"))
            Schema::create('interviews', function (Blueprint $table) {
                $table->id();
                $table->integer('application_id', false);
                $table->date('date');
                $table->time('time')->nullable();
                $table->string('type');
                $table->text('venue')->nullable();
                $table->integer('status', false)->default(0);
                $table->boolean('notified')->default(false);
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
        Schema::dropIfExists('interviews');
    }
}
