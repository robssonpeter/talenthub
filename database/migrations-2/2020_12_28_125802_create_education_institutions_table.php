<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationInstitutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education_institutions', function (Blueprint $table) {
            $table->id();
            $table->integer('country_id');
            $table->integer('city_id')->nullable();
            $table->string('name');

            $table->timestamps();
        });
        \App\Functionalities\FeedData::schools();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('education_institutions');
    }
}
