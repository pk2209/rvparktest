<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOffersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        /*
		Schema::create('Offers', function(Blueprint $table) {
			$table->bigIncrements('ID');
			$table->bigInteger('ProviderID');
			$table->bigInteger('OfferTypeID');
			$table->bigInteger('AdvertisingLevelID');
			$table->string('Title', 50);
			$table->text('Description', 900);
			$table->text('FinePrint', 500);
			$table->float('FullPrice');
			$table->float('PriceBeforeDiscount');
			$table->float('Discount');
			$table->date('StartDate');
			$table->date('EndDate');
			$table->date('RedeemByDate');
			$table->integer('QuantityLimit');
			$table->integer('ClaimedCount');
			$table->string('OfferImage');
			$table->boolean('OfferActive');
			$table->float('Latitude');
			$table->float('Longitude');
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
		Schema::drop('Offers');
        */
	}

}
