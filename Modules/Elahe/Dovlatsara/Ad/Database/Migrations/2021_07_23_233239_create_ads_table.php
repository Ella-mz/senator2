<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')
                ->onDelete('cascade');
            $table->unsignedBigInteger('neighborhood_id');
            $table->string('uniqueCodeOfAd')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('mobile')->nullable();
            $table->bigInteger('viewCount')->nullable();
            $table->string('latitude')->nullable();//عرض جغرافیایی
            $table->string('longitude')->nullable();//طول جغرافیایی
            $table->string('advertiser')->nullable();
            $table->string('type')->nullable();
            $table->string('paymentType')->nullable();
            $table->string('isPaid')->nullable();
            $table->string('startDate')->nullable();
            $table->string('endDate')->nullable();
            $table->boolean('showMobile')->default(1);
            $table->boolean('showEmail')->default(1);
            $table->boolean('hasChat')->default(1);
            $table->boolean('hasEmail')->default(1);
            $table->string('userStatus')->nullable();
            $table->string('deactivationReason');
            $table->tinyInteger('active')->default(1);
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
        Schema::dropIfExists('ads');
    }
}
