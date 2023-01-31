<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
                        $table->increments('id');


            $table->timestamps();
            $table->integer('customer_id')->unsigned();
            $table->integer('offers_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');;
            $table->foreign('offers_id')->references('id')->on('offers')->onDelete('cascade');;
            $table->enum('status', [
                'available',
                'not available'
            ])->nullable();
            $table->dateTime('satrt')->nullable();
            $table->dateTime('end')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
