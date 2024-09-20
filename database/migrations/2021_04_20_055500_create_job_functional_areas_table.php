<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobFunctionalAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable("job_functional_areas"))
            Schema::create('job_functional_areas', function (Blueprint $table) {
                $table->id();
                $table->unsignedInteger('job_id');
                $table->integer('functional_area_id');
                $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
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
        Schema::dropIfExists('job_functional_areas');
    }
}
