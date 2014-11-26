<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProvidersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        /*
		Schema::create('Providers', function(Blueprint $table) {
			$table->bigIncrements('ID');
			$table->bigInteger('PCID');
			$table->bigInteger('SubID');
			$table->string('CompanyName', 250);
			$table->string('Street', 250);
			$table->string('City', 250);
			$table->string('State', 2);
			$table->string('Zip', 10);
			$table->string('Country', 3);
            $table->text('ZipCodeServiced');
			$table->string('Phone', 50);
			$table->string('Email', 250);
			$table->string('Website', 250);
			$table->float('Latitude');
			$table->float('Longitude');
			$table->integer('Ratings');
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
		Schema::drop('Providers');
        */
	}

}
