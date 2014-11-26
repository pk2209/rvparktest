<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRedeemedOffersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        /*
		Schema::create('RedeemedOffers', function(Blueprint $table) {
			$table->bigIncrements('ID');
			$table->bigInteger('OfferID');
			$table->bigInteger('PetParentID');
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
		Schema::drop('RedeemedOffers');
        */
	}

}
