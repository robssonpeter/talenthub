<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCareerLevelIdColumnToCandidateExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidate_experiences', function (Blueprint $table) {
            $table->integer('career_level_id', false)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('candidate_experiences', function (Blueprint $table) {
            $table->dropColumn('career_level_id');
        });
    }
}
