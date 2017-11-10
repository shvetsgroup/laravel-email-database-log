<?php

use Illuminate\Database\Migrations\Migration;

class AddMoreMailColumnsEmailLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('email_log', function ($table) {
            $table->increments('id')->first();
            $table->string('from')->after('date')->nullable();
            $table->string('cc')->after('to')->nullable();
            $table->text('headers')->after('body')->nullable();
            $table->text('attachments')->after('headers')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('email_log', function ($table) {
            $table->dropColumn('id');
            $table->dropColumn('from');
            $table->dropColumn('cc');
            $table->dropColumn('headers');
            $table->dropColumn('attachments');
        });
    }
}
