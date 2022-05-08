<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddResponsiveImageToAdvertisingUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('advertising_user', function (Blueprint $table) {
            $table->string('responsive_image')->nullable()->after('image_title');
            $table->string('responsive_image_title')->nullable()->after('responsive_image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('advertising_user', function (Blueprint $table) {
            //
        });
    }
}
