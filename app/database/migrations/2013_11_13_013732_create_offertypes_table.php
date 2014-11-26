<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOfferTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        /*
		Schema::create('OfferTypes', function(Blueprint $table) {
			$table->bigIncrements('ID');
			$table->string('Title', 50);
			$table->text('FinePrint', 500);
            $table->text('RedeemStep');
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
		Schema::drop('OfferTypes');
        */
	}

}
