<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->unsignedbigInteger('article_group_id')->unsigned();
            $table->foreign('article_group_id')->references('id')
                ->on('article_groups')->onDelete('CASCADE')->onUpdate('NO ACTION');
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->string('image')->nullable();
            $table->string('video')->nullable();
            $table->boolean('news')->default(0);
            $table->text('shortDescription')->nullable();
            $table->longText('description')->nullable();
            $table->integer('view')->default(0);
            $table->enum('status',\Modules\Article\Entities\Article::$enumStatuses)->default('active');
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
        Schema::dropIfExists('articles');
    }
}
