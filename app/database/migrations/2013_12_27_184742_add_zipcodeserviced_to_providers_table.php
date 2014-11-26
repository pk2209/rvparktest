<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddZipcodeservicedToProvidersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        /*
		Schema::table('Providers', function(Blueprint $table) {
			$table->text('ZipCodeServiced')->after('Country')->nullable();
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
		Schema::table('Providers', function(Blueprint $table) {
			$table->dropColumn('ZipCodeServiced');
		});
        */
	}

}
