<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateZipcodesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('petpaws.ZipCodes', function(Blueprint $table)
		{
			$table->bigIncrements('ID');
            $table->string('ZipCode', 10);
            $table->decimal('Latitude',9,6)->nullable();
            $table->decimal('Longitude',9,6)->nullable();
            $table->string('Locality')->nullable();
            $table->string('Region', 10);
            $table->string('Type')->nullable();

			$table->timestamps();

            $table->index('ZipCode');
            $table->index('Region');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('petpaws.ZipCodes');
	}

}
