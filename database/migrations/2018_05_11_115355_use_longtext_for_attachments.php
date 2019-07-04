2018_09_10_141916_create_email_log_events_table.php<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UseLongtextForAttachments extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('email_log', function (Blueprint $table) {
			$table->longText('attachments')->nullable()->change();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('email_log', function (Blueprint $table) {
			$table->text('attachments')->nullable()->change();
		});
	}

}
