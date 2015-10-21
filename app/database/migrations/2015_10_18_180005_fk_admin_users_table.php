<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FkAdminUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('admin_users', function(Blueprint $table)
		{
			$table->integer('roles_id')->unsigned();
			$table->foreign('roles_id')->references('id')->on('roles');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('admin_users', function(Blueprint $table)
		{
			$table->dropForeign('admin_users_roles_id_foreign');
		});
	}

}
