<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScoreTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('score_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedbigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('CASCADE')->onUpdate('NO ACTION');
            $table->integer('score_id')->nullable();
            $table->integer('bonus')->default(0);   //امتیاز ریالی
            $table->integer('grant')->default(0);   //امتیاز غیرریالی
            $table->enum('type',\Modules\CostumerClub\Entities\ScoreTransaction::$enumTypes);
            $table->Text('description')->nullable();
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
        Schema::dropIfExists('score_transactions');
    }
}
