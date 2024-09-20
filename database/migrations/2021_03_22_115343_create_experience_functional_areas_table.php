<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperienceFunctionalAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable("experience_functional_areas"))
            Schema::create('experience_functional_areas', function (Blueprint $table) {
                $table->id();
                $table->integer('experience_id');
                $table->integer('functional_area_id');
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
        Schema::dropIfExists('experience_functional_areas');
    }
}
