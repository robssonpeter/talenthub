<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTemplateIdColumnToInterviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('interviews', 'template_id'))
            Schema::table('interviews', function (Blueprint $table) {
                $table->integer('template_id', false)->after('venue')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('interviews', function (Blueprint $table) {
            $table->dropColumn('template_id');
        });
    }
}
