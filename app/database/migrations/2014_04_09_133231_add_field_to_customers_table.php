<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddFieldToCustomersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('petpaws.Customers', function(Blueprint $table)
		{
            $table->string('City')->after('Address');
            $table->string('State')->after('City');
            $table->string('ZipCode')->after('State');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('petpaws.Customers', function(Blueprint $table)
		{
            $table->dropColumn('City');
            $table->dropColumn('State');
            $table->dropColumn('ZipCode');
		});
	}

}
