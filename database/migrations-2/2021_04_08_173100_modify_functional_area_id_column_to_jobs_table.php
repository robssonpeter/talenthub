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
            /*if(Schema::hasColumn('jobs', 'functional_area_id')){
                $table->text('functional_area_id')->change();
            }else{
                $table->text('functional_area_id');
            }*/

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
