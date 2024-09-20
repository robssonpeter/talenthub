<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyVerificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable("company_verifications"))
            Schema::create('company_verifications', function (Blueprint $table) {
                $table->id();
                $table->integer('company_id', false);
                $table->string('document')->nullable();
                $table->integer('verified_by')->nullable();
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_verifications');
    }
}
