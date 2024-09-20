<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidateRefereesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_referees', function (Blueprint $table) {
            $table->id();
            $table->integer('candidate_id',false);
            $table->string('name');
            $table->string('region_code');
            $table->string('phone');
            $table->string('position');
            $table->string('email');
            $table->string('company');
            $table->string('postal_address');
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
        Schema::dropIfExists('candidate_referees');
    }
}
