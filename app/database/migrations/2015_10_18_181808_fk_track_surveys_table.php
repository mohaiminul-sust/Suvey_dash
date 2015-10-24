<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FkTrackSurveysTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('track_surveys', function(Blueprint $table)
		{
			$table->integer('surveys_id')->unsigned();
			$table->foreign('surveys_id')->references('id')->on('surveys')->onUpdate('cascade')->onDelete('cascade');

			$table->integer('users_id')->unsigned();
			$table->foreign('users_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('track_surveys', function(Blueprint $table)
		{

			$table->dropForeign('track_surveys_surveys_id_foreign');
			$table->dropForeign('track_surveys_users_id_foreign');
		
		});
	}

}
