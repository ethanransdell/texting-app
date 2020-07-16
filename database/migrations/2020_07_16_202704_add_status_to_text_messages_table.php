<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToTextMessagesTable extends Migration
{
    public function up()
    {
        Schema::table('text_messages', function (Blueprint $table) {
            $table
                ->string('status')
                ->after('service_name')
                ->nullable();
        });
    }

    public function down()
    {
        Schema::table('text_messages', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
