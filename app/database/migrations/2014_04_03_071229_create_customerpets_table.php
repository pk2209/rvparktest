<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCustomerpetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('petpaws.CustomerPets', function(Blueprint $table)
		{
			$table->bigIncrements('ID');
            $table->bigInteger('CustomerID');
            $table->string('PetName');
            $table->string('PetSpecies');
            $table->string('Breed');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('petpaws.CustomerPets');
	}

}
