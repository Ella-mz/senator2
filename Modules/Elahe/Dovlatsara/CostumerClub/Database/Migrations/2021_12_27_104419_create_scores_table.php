<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->string('input_slug')->nullable();
            $table->integer('bonus')->default(0);   //امتیاز ریالی
            $table->integer('grant')->default(0);   //امتیاز غیرریالی
            $table->enum('type', \Modules\CostumerClub\Entities\Score::$enumTypes)->default('increase');
            $table->Text('description')->nullable();
            $table->enum('status', \Modules\CostumerClub\Entities\Score::$enumStatuses)->default('active');
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
        Schema::dropIfExists('scores');
    }
}
