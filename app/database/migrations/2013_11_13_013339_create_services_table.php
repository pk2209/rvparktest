<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateServicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        /*
		Schema::create('Services', function(Blueprint $table) {
			$table->bigIncrements('ID');
			$table->string('Name', 50);
			$table->bigInteger('ParentID');
			$table->timestamps();
		});
        */
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        /*
		Schema::drop('Services');
        */
	}

}
