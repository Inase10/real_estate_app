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
        Schema::create('properties', function (Blueprint $table) {
                 $table->increments('id');
                 $table->string('cover_image')->nullable();


            $table->timestamps();
            $table->double('area')->nullable();
            $table->integer('room_num')->nullable();
            $table->integer('bath_num')->nullable();
            $table->integer('locations_id')->unsigned();

            $table->integer('storey')->nullable();
            $table->double('price')->nullable();
            $table->double('price_rent_per_day')->nullable();

            $table->text('discrption');

             $table->foreign('locations_id')->references('id')->on('locations')->onDelete('cascade');;


            $table->enum('type', [
                'apartment',
                'house',
                'land',
                'office',
                'chalet'
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
        Schema::dropIfExists('properties');
    }
};
