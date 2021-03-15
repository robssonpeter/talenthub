<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReportsToColumnToJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('jobs', 'reports_to')){
            Schema::table('jobs', function (Blueprint $table) {
                $table->string('reports_to')->after('job_title')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(Schema::hasColumn('jobs', 'reports_to')){
            Schema::table('jobs', function (Blueprint $table) {
                $table->dropColumn('reports_to');
            });
        }
    }
}
