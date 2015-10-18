<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FkSurveysTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('surveys', function(Blueprint $table)
		{
			$table->integer('admin_users_id')->unsigned();
			$table->foreign('admin_users_id')->references('id')->on('admin_users')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('surveys', function(Blueprint $table)
		{
			
			$table->dropForeign('surveys_admin_users_id_foreign');
			
		});
	}

}
