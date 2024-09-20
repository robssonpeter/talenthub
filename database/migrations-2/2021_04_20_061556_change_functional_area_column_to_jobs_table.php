<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeFunctionalAreaColumnToJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropForeign('jobs_functional_area_id_foreign');
            if(Schema::hasColumn('jobs', 'functional_area_id')){
                $table->dropColumn('functional_area_id');
            }
            if(Schema::hasColumn('jobs', 'functional_areas')){
                $table->text('functional_areas')->after('industry_id')->nullable()->change();
            }else{
                $table->text('functional_areas')->after('industry_id')->nullable();
            }

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
            $table->dropColumn('functional_area_id');
            /*$table->unsignedInteger('functional_area_id');*/
            /*$table->foreign('functional_area_id')->references('id')->on('functional_areas')
                ->onUpdate('cascade')
                ->onDelete('cascade');*/
        });
    }
}
