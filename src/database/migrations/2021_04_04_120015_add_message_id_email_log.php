<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddMessageIdEmailLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('email_log', function (Blueprint $table) {
            $table->string('message_id')->nullable();
            $table->index(['message_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('email_log', function (Blueprint $table) {
            $table->dropColumn('message_id');
        });
    }
}
