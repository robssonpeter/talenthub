<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraColumnsToCandidateAchievementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidate_achievements', function (Blueprint $table) {
            if(!Schema::hasColumn('candidate_achievements', 'country_id')){
                $table->integer('country_id', false)->nullable();
            }
            if(!Schema::hasColumn('candidate_achievements', 'institution_id'))
                $table->integer('institution_id', false)->nullable();
            if(!Schema::hasColumn('candidate_achievements', 'category_id'))
                $table->integer('category_id', false)->nullable();
            if(!Schema::hasColumn('candidate_achievements', 'completion_date'))
                $table->date('completion_date')->nullable();
            if(!Schema::hasColumn('candidate_achievements', 'valid_until'))
                $table->date('valid_until')->nullable();
            if(!Schema::hasColumn('candidate_achievements', 'ongoing'))
                $table->boolean('ongoing')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('candidate_achievements', function (Blueprint $table) {
            //
        });
    }
}
