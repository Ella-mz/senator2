<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders')
                ->onDelete('cascade');
            $table->string('price');
            $table->string('merchant_code')->nullable();
            $table->string('resNum')->nullable();
            $table->string('refId')->nullable();
            $table->string('start_gateway_page')->nullable();
            $table->string('call_back_route_name')->nullable();
            $table->enum('gateway', \Modules\Payment\Entities\Payment::$gatewayType);
            $table->enum('status', \Modules\Payment\Entities\Payment::$statusType)->default('unpaid');
            $table->string('date')->nullable();
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
        Schema::dropIfExists('payments');
    }
}
