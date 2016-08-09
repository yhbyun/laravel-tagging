<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTagTable extends Migration {

	public function up()
	{
		Schema::create('tag', function(Blueprint $table) {
			$table->increments('id');
			$table->string('slug', 255)->index();
			$table->string('name', 255);
			$table->boolean('suggest')->default(false);
			$table->integer('cnt')->unsigned()->default(0); // count of how many times this tag was used
            $table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('tag');
	}
}
