<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyFunctionalAreaIdColumnToJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobs', function (Blueprint $table) {
            //$table->dropIfExists('jobs_functional_area_id_foreign');
            //$table->dropForeign('jobs_functional_area_id_foreign');
            $table->text('functional_area_id')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->unsignedInteger('functional_area_id')->change();
        });
    }
}
