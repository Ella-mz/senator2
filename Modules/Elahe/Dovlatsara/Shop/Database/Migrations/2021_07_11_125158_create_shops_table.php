<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('union_id');
            $table->foreign('union_id')->references('id')
                ->on('unions')->onDelete('cascade');
            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')->references('id')
                ->on('cities')->onDelete('cascade');
            $table->unsignedBigInteger('neighborhood_id')->nullable();
            $table->string('identifierCode')->nullable();
            $table->string('title')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('logo')->nullable();
            $table->string('yearOfOperation')->nullable();
            $table->string('slug')->nullable();
            $table->text('description')->nullable();
            $table->string('website')->nullable();
            $table->string('reasonOfDeactivation')->nullable();
            $table->boolean('active')->default(0);
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
        Schema::dropIfExists('shops');
    }
}
