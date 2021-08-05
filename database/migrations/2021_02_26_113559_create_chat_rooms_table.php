<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_rooms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer("sender_user_id")->unsigned();
            $table->foreign('sender_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer("receiver_user_id")->unsigned();
            $table->foreign('receiver_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string("message")->nullable();
            $table->date("deleted_at")->nullable();
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
        Schema::dropIfExists('chat_rooms');
    }
}
