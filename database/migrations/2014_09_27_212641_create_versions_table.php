<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVersionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('test_unifiber_map_versions', function(Blueprint $table)
		{
			$table->increments('version_id');
			$table->string('versionable_id');
			$table->string('versionable_type');
			$table->string('user_id')->nullable();
			$table->longText('model_data');
			$table->longText('old_data');
			$table->longText('new_data');
			$table->string('reason', 100)->nullable();
			$table->integer('version');
			$table->index('versionable_id');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('versions');
	}

}
