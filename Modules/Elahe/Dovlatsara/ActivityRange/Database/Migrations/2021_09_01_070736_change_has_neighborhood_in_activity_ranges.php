<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeHasNeighborhoodInActivityRanges extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activity_ranges', function (Blueprint $table) {
            $table->renameColumn('hasNeighborhood', 'allNeighborhoods');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activity_ranges', function (Blueprint $table) {
            $table->renameColumn('allNeighborhoods', 'hasNeighborhood');
        });
    }
}
