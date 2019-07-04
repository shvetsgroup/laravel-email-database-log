<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailLogEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_log_events', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('messageId', 32);
            $table->string('event');
            $table->text('data');
        });
        Schema::table('email_log_events', function (Blueprint $table) {
            $table->index('messageId');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('email_log_events', function (Blueprint $table) {
            $table->dropIndex(['messageId']);
        });
        Schema::dropIfExists('email_log_events');
    }
}
