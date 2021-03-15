<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterResultColumnToCandidateEducationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidate_educations', function (Blueprint $table) {
            $table->string('result')->nullable()->change();
            $table->string('year')->nullable()->change();
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
            $table->string('result')->change();
            $table->string('year')->change();
        });
    }
}
