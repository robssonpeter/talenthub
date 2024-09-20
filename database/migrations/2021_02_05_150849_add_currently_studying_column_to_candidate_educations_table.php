<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCurrentlyStudyingColumnToCandidateEducationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('candidate_educations', 'currently_studying'))
            Schema::table('candidate_educations', function (Blueprint $table) {
                $table->boolean('currently_studying')->nullable();
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
            $table->dropColumn('currently_studying');
        });
    }
}
