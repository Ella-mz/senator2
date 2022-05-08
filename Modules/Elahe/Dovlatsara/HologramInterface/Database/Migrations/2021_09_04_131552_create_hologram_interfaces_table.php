<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHologramInterfacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hologram_interfaces', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hologram_id');
            $table->foreign('hologram_id')->references('id')->on('holograms')
                ->onDelete('cascade');
            $table->string('type')->nullable();
            $table->unsignedBigInteger('type_id')->nullable();
            $table->string('status')->default('pending');
            $table->text('description')->nullable();
            $table->string('hologram_price')->nullable();
            $table->string('expert_id')->nullable();
            $table->text('expert_description')->nullable();
            $table->string('expert_answer_time')->nullable();
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
        Schema::dropIfExists('hologram_interfaces');
    }
}
