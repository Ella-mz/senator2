<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlePositionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_position', function (Blueprint $table) {
            $table->id();
            $table->unsignedbigInteger('article_id')->unsigned();
            $table->foreign('article_id')->references('id')
                ->on('articles')->onDelete('CASCADE')->onUpdate('NO ACTION');

            $table->unsignedbigInteger('position_id')->unsigned();
            $table->foreign('position_id')->references('id')
                ->on('positions')->onDelete('CASCADE')->onUpdate('NO ACTION');

            $table->integer('order')->default(1);
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
        Schema::dropIfExists('article_position');
    }
}
