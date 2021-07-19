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
            if(Schema::hasColumn('candidate_achievements', 'country_id')){
                $table->integer('country_id', false)->nullable();
            }
            $table->integer('institution_id', false)->nullable();
            $table->integer('category_id', false)->nullable();
            $table->date('completion_date')->nullable();
            $table->date('valid_until')->nullable();
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
