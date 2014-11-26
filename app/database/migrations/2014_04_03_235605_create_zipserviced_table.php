<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateZipservicedTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('petpaws.ZipServiced', function(Blueprint $table)
		{
            $table->bigInteger('ProviderID');
            $table->string('ZipCode');

            $table->unique(array('ProviderID', 'ZipCode'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('petpaws.ZipServiced');
	}

}
