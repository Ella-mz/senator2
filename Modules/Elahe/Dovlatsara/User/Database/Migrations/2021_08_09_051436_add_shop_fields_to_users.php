<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddShopFieldsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('shop_city_id')->nullable()->after('active');
            $table->unsignedBigInteger('shop_neighborhood_id')->nullable()->after('shop_city_id');
            $table->string('shop_title')->nullable()->after('shop_neighborhood_id');
            $table->string('shop_phone')->nullable()->after('shop_title');
            $table->string('shop_address')->nullable()->after('shop_phone');
            $table->string('shop_latitude')->nullable()->after('shop_address');
            $table->string('shop_longitude')->nullable()->after('shop_latitude');
            $table->string('shop_logo')->nullable()->after('shop_longitude');
            $table->string('shop_description')->nullable()->after('shop_logo');
            $table->string('shop_website')->nullable()->after('shop_description');
            $table->string('shop_active')->default('inactive')->after('shop_website');
            $table->text('shop_reasonOfDeactivation')->nullable()->after('shop_active');

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
            $table->dropColumn('shop_city_id');
            $table->dropColumn('shop_neighborhood_id');
            $table->dropColumn('shop_title');
            $table->dropColumn('shop_phone');
            $table->dropColumn('shop_address');
            $table->dropColumn('shop_latitude');
            $table->dropColumn('shop_longitude');
            $table->dropColumn('shop_logo');
            $table->dropColumn('shop_description');
            $table->dropColumn('shop_website');
            $table->dropColumn('shop_active');
            $table->dropColumn('shop_reasonOfDeactivation');
        });
    }
}
