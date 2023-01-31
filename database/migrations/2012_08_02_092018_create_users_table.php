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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');

            $table->string('first_name')->nullable();
$table->string('last_name')->nullable();
$table->string('email')->nullable()->unique();
$table->string('avatar')->nullable();
$table->string('bio')->nullable();
$table->string('password')->nullable();
$table->string('remember_token')->nullable();
$table->enum('user_type',[
 'Customer',
 'Seller',
 'Admin'
])->nullable();
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
        Schema::dropIfExists('users');
    }
};
