<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTextMessagingDriveToTextMessagesTable extends Migration
{
    public function up()
    {
        Schema::table('text_messages', function (Blueprint $table) {
            $table
                ->string('service_name')
                ->nullable()
                ->after('user_id');
        });
    }

    public function down()
    {
        Schema::table('text_messages', function (Blueprint $table) {
            $table->dropColumn('service_name');
        });
    }
}
