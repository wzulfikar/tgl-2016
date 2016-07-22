<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLocationsTable extends Migration {

	public function up()
	{
		Schema::create('locations', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('locatable_id');
			$table->string('locatable_type');
			$table->float('lat');
			$table->float('lng');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('locations');
	}
}