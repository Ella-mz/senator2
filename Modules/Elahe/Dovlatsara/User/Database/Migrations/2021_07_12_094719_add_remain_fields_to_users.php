<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRemainFieldsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('sirName')->nullable()->after('name');
            $table->string('mobile')->nullable()->after('email');
            $table->string('userImage')->nullable()->after('password');
            $table->tinyInteger('sex')->nullable()->after('userImage');
            $table->string('birthDate')->nullable()->after('sex');
            $table->string('identifierCodeFromRealEstate')->nullable()->after('birthDate');
            $table->string('nationalCardImage')->nullable()->after('identifierCodeFromRealEstate');
            $table->string('shenasnamehImage')->nullable()->after('nationalCardImage');
            $table->string('yearOfOperation')->nullable()->after('shenasnamehImage');
            $table->string('mobasherCardImage')->nullable()->after('yearOfOperation');
            $table->string('businessLicenseImage')->nullable()->after('mobasherCardImage');
            $table->string('unionCardImage')->nullable()->after('businessLicenseImage');
            $table->string('phoneNumberForAds')->nullable()->after('unionCardImage');
            $table->string('slug')->nullable()->after('phoneNumberForAds');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('sirName');
            $table->dropColumn('mobile');
            $table->dropColumn('userImage');
            $table->dropColumn('sex');
            $table->dropColumn('birthDate');
            $table->dropColumn('identifierCodeFromRealEstate');
            $table->dropColumn('nationalCardImage');
            $table->dropColumn('shenasnamehImage');
            $table->dropColumn('yearOfOperation');
            $table->dropColumn('mobasherCardImage');
            $table->dropColumn('businessLicenseImage');
            $table->dropColumn('unionCardImage');
            $table->dropColumn('phoneNumberForAds');
            $table->dropColumn('slug');
        });
    }
}
