<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProviderServicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        /*
		Schema::create('ProviderServices', function(Blueprint $table) {
			$table->bigIncrements('ID');
			$table->bigInteger('ProviderID');
			$table->bigInteger('ServiceID');
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
		Schema::drop('ProviderServices');
        */
	}

}
