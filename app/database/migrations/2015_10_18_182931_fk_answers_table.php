<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FkAnswersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('answers', function(Blueprint $table)
		{
			$table->integer('users_id')->unsigned();
			$table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');

			$table->integer('questions_id')->unsigned();
			$table->foreign('questions_id')->references('id')->on('questions')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('answers', function(Blueprint $table)
		{
			$table->dropForeign('answers_users_id_foreign');
			$table->dropForeign('answers_questions_id_foreign');

		});
	}

}
