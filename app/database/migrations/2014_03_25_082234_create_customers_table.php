<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCustomersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('petpaws.Customers', function(Blueprint $table) {
			$table->bigIncrements('ID');
            $table->bigInteger('ProviderID');
            $table->string('FirstName');
            $table->string('LastName');
            $table->string('Email');
            $table->string('Phone');
            $table->string('MobilePhone');
            $table->dateTime('LastVisit')->nullable();
            $table->text('Address');
            $table->text('Notes')->nullable();
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
		Schema::drop('petpaws.Customers');
	}

}
