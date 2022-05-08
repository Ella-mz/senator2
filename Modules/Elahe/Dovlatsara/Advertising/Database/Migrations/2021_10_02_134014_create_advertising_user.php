<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisingUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertising_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade');
            $table->unsignedBigInteger('advertising_id');
            $table->foreign('advertising_id')->references('id')
                ->on('advertisings')->onDelete('cascade');
            $table->string('link')->nullable();
            $table->string('image')->nullable();
            $table->string('category')->nullable();
            $table->string('startDate')->nullable();
            $table->string('endDate')->nullable();
            $table->bigInteger('clickCount')->default(0);
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
        Schema::dropIfExists('advertising_user');
    }
}
