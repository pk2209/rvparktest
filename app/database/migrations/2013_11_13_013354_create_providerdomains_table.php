<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProviderDomainsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        /*
		Schema::create('ProviderDomains', function(Blueprint $table) {
			$table->bigIncrements('ID');
			$table->string('Name');
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
		Schema::drop('ProviderDomains');
        */
	}

}
