<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDomainMembersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        /*
		Schema::create('DomainMembers', function(Blueprint $table) {
			$table->bigIncrements('ID');
			$table->bigInteger('ProviderDomainID');
			$table->bigInteger('ProviderCredentialID');
			$table->boolean('Admin');
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
		Schema::drop('DomainMembers');
        */
	}

}
