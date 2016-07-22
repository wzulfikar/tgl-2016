<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdsTable extends Migration {

	public function up()
	{
		Schema::create('ads', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title');
			$table->string('desc');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('ads');
	}
}