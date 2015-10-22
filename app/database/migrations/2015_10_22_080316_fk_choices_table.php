<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FkChoicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('choices', function(Blueprint $table)
		{
			$table->integer('questions_id')->unsigned();
			$table->foreign('questions_id')->references('id')->on('questions')->onDelete('cascade')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('choices', function(Blueprint $table)
		{
			$table->dropForeign('choices_questions_id_foreign');
		});
	}

}
