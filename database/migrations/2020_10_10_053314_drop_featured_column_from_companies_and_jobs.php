<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropFeaturedColumnFromCompaniesAndJobs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasColumn('jobs', 'is_featured'))
            Schema::table('jobs', function (Blueprint $table) {
                $table->dropColumn('is_featured');
            });

        if(Schema::hasColumn('companies', 'is_featured'))
            Schema::table('companies', function (Blueprint $table) {
                $table->dropColumn('is_featured');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies_and_jobs', function (Blueprint $table) {
            //
        });
    }
}
