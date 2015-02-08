<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventTypeTable extends Migration {
public function up()
	{
		Schema::create('type_food', function($table)
		{
			$table->increments('id');
			$table->string('latlng');
			$table->string('type');
			$table->integer('event_id');
			$table->integer('user_id');
			$table->timestamps();

			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('type_food');
	}


}
