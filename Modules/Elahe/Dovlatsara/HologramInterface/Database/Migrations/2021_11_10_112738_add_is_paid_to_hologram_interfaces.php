<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsPaidToHologramInterfaces extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hologram_interfaces', function (Blueprint $table) {
            $table->boolean('isPaid')->default(0)->after('expert_answer_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hologram_interfaces', function (Blueprint $table) {
            $table->dropColumn('isPaid');
        });
    }
}
