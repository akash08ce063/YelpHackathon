<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActiveEventTable extends Migration {

	public function up()
	{
		Schema::create('active_event', function($table)
		{
			$table->increments('id');
			$table->integer('event_id');
			$table->integer('user_id');
			$table->enum('is_submitted', array('true', 'false'))->nullable();
			
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
		Schema::drop('active_event');
	}


}
