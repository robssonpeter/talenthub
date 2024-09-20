<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveSocialLinksFromCompanies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::table('companies', function (Blueprint $table) {
            if(Schema::hasColumn('companies', 'facebook_url'))
                $table->dropColumn('facebook_url');
            if(Schema::hasColumn('companies', 'twitter_url'))
                $table->dropColumn('twitter_url');
            if(Schema::hasColumn('companies', 'linkedin_url'))
                $table->dropColumn('linkedin_url');
            if(Schema::hasColumn('companies', 'google_plus_url'))
                $table->dropColumn('google_plus_url');
            if(Schema::hasColumn('companies', 'pinterest_url'))
                $table->dropColumn('pinterest_url');
        });
    }


}
