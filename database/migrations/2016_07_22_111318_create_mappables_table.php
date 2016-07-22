<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMappablesTable extends Migration {

	public function up()
	{
		Schema::create('mappables', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('mappable_id');
			$table->integer('mappable_type');
			$table->float('lat');
			$table->float('lng');
			$table->integer('user_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('mappables');
	}
}