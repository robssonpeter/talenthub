<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraColumnsToCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->string('address_line_1')->after('location')->nullable();
            $table->string('address_line_2')->after('address_line_1')->nullable();
            $table->string('zip_code')->after('address_line_2')->nullable();
            $table->string('postal_address')->after('zip_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn(['address_line_1', 'address_line_2', 'zip_code', 'postal_address']);
        });
    }
}
