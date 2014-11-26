<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAppointmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('petpaws.Appointments', function(Blueprint $table) {
			$table->bigIncrements('ID');
            $table->bigInteger('ProviderID');
            $table->bigInteger('CustomerID');

            /**appointment info*/
            $table->dateTime('DateStart');
            $table->dateTime('DateEnd');
            $table->string('AppointmentType');
            $table->dateTime('Reminder');
            $table->string('Title');
            $table->string('AppointmentStatus');
            $table->text('Notes')->nullable();

            /** pet info */
            $table->string('PetName')->nullable();
            $table->string('PetSpecies')->nullable();
            $table->string('PetBreed')->nullable();
            $table->string('VetName')->nullable();
            $table->boolean('Vaccine')->nullable();

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
		Schema::drop('petpaws.Appointments');
	}

}
