<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTaggedTable extends Migration {

	public function up() {
		Schema::create('tagged', function(Blueprint $table) {
			$table->increments('id');
			if(config('tagging.primary_keys_type') == 'string') {
				$table->string('taggable_id', 36)->index();
			} else {
				$table->integer('taggable_id')->unsigned()->index();
			}
			$table->string('taggable_type', 255)->index();
			$table->string('tag_name', 255);
			$table->string('tag_slug', 255)->index();
            $table->timestamps();
		});
	}

	public function down() {
		Schema::drop('taggable_tag');
	}
}
