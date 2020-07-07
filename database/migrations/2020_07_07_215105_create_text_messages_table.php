<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTextMessagesTable extends Migration
{
    public function up()
    {
        Schema::create('text_messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('message_id');
            $table->string('to');
            $table->string('from');
            $table->string('body');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('text_messages');
    }
}
