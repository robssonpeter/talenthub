<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJobCategoryIdColumnToCandidateExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('candidate_experiences', 'industry_id'))
            Schema::table('candidate_experiences', function (Blueprint $table) {
                $table->integer('job_category_id', false)->after('company')->nullable();
                $table->integer('industry_id', false)->after('job_category_id')->nullable();
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
            $table->dropColumn('job_category_id', 'industry_id');
        });
    }
}
