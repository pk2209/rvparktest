<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddRedeemstepToOffertypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        /*/
		Schema::table('OfferTypes', function(Blueprint $table) {
			$table->text('RedeemStep')->after('FinePrint')->nullable();
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
		Schema::table('OfferTypes', function(Blueprint $table) {
			$table->dropColumn('RedeemStep');
		});
        */
	}


}
