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
        Schema::create('offers', function (Blueprint $table) {
            $table->increments('id');

            $table->timestamps();
            $table->integer('seller_id')->unsigned();
            $table->integer('approved_by')->unsigned();
            $table->integer('property_id')->unsigned();
            $table->foreign('seller_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('approved_by')->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
            $table->dateTime('approve_date')->nullable();
            $table->enum('offer_type', [
                'rent',
                'Sale'
            ])->nullable();
            $table->enum('status', [
                'pending',
                'approved',
                'rejected',
                'rented',
                'sold',
            ])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offers');
    }
};
