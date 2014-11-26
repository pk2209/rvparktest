<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCustomerPurchasesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('petpaws.CustomerPurchases', function(Blueprint $table)
		{
			$table->bigIncrements('ID');
            $table->bigInteger('CustomerID');
            $table->bigInteger('OfferID');
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
		Schema::drop('petpaws.CustomerPurchases');
	}

}
