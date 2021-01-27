<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_rooms', function (Blueprint $table) {
          $table->id();
          $table->bigInteger('room_id')->unsigned()->index();
          $table->bigInteger('user_id')->unsigned()->index();

          $table->softDeletes();
          $table->timestamps();

          $table->foreign('room_id')->references('id')->on('rooms')
            ->onDelete('cascade');

          $table->foreign('user_id')->references('id')->on('users')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_rooms');
    }
}
