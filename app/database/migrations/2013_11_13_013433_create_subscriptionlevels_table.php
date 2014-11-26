<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubscriptionLevelsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        /*
		Schema::create('SubscriptionLevels', function(Blueprint $table) {
			$table->bigIncrements('ID');
			$table->string('Description', 100);
			$table->float('Price');
			$table->bigInteger('Offers');
			$table->float('MarketReach');
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
		Schema::drop('SubscriptionLevels');
        */
	}

}
