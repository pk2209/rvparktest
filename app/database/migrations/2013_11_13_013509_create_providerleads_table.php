<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProviderLeadsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        /*
		Schema::create('ProviderLeads', function(Blueprint $table) {
			$table->bigIncrements('ID');
			$table->bigInteger('ProviderID');
			$table->bigInteger('PCID');
			$table->string('Name', 100);
			$table->string('CompanyName', 100);
			$table->string('Email', 250);
			$table->string('Phone', 50);
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
		Schema::drop('ProviderLeads');
        */
	}

}
