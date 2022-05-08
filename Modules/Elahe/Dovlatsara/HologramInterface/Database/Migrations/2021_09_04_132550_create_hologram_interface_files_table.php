<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHologramInterfaceFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hologram_interface_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hologram_interface_id');
            $table->foreign('hologram_interface_id')->references('id')->on('hologram_interfaces')
                ->onDelete('cascade');
            $table->string('file_address')->nullable();
            $table->string('file_name')->nullable();
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
        Schema::dropIfExists('hologram_interface_files');
    }
}
