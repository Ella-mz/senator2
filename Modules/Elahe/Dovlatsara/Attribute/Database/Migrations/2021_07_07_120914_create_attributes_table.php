<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('groupAttribute_id');
            $table->foreign('groupAttribute_id')->references('id')
                ->on('group_attributes')->onDelete('cascade');
            $table->string('title');
            $table->string('attribute_type')->nullable();
            $table->string('input_type')->nullable();
            $table->string('unit')->nullable();
            $table->integer('min')->nullable();
            $table->integer('max')->nullable();
            $table->boolean('isSignificant')->default(0);
            $table->boolean('isFilterField')->default(0);
            $table->boolean('active')->default(1);
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
        Schema::dropIfExists('attributes');
    }
}
