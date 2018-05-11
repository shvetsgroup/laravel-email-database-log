<?php

use Illuminate\Database\Migrations\Migration;

class UseLongtextForAttachments extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		DB::statement('ALTER TABLE email_log MODIFY COLUMN attachments LONGTEXT');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		DB::statement('ALTER TABLE email_log MODIFY COLUMN attachments TEXT');
	}

}
