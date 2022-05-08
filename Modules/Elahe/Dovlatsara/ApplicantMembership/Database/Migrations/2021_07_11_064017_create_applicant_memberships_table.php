<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicantMembershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicant_memberships', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->nullable();
//            $table->foreign('category_id')->references('id')
//                ->on('categories')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->string('role_type')->nullable();
            $table->string('duration')->nullable();
            $table->string('price')->nullable();
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
        Schema::dropIfExists('applicant_memberships');
    }
}
