<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyVerificationRejectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable("company_verification_rejections"))
            Schema::create('company_verification_rejections', function (Blueprint $table) {
                $table->id();
                $table->text('reason');
                $table->integer('attempt_id', false);
                $table->integer('company_id', false);
                $table->integer('rejected_by', false);
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
        Schema::dropIfExists('company_verification_rejections');
    }
}
