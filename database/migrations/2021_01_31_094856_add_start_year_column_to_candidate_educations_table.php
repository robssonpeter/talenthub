<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStartYearColumnToCandidateEducationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('candidate_educations', 'start_year'))
            Schema::table('candidate_educations', function (Blueprint $table) {
                $table->integer('start_year', false)->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('candidate_educations', function (Blueprint $table) {
            $table->dropColumn('start_year')->after('result');
        });
    }
}
