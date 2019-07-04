<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOnDeleteCascadeToEmailLogEventsTableMessageIdColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('email_log_events', function (Blueprint $table) {
            $table->dropIndex(['messageId']);
            $table->foreign('messageId')
                ->references('messageId')->on('email_log')
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
        Schema::table('email_log_events', function (Blueprint $table) {
            $table->dropForeign(['messageId']);
            $table->index('messageId');
        });
    }
}
