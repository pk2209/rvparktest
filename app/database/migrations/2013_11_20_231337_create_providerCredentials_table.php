<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProviderCredentialsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        Schema::create('ProviderCredentials', function(Blueprint $table) {
            $table->bigIncrements('ID');
            $table->string('UserName')->nullable();
            $table->string('Email');
            $table->string('CompanyName');
            $table->string('FirstName', 50)->nullable();
            $table->string('LastName', 50)->nullable();
            $table->string('Hash');


			$table->string('password');
			$table->text('permissions')->nullable();
			$table->boolean('activated')->default(0);
			$table->string('activation_code')->nullable();
			$table->timestamp('activated_at')->nullable();
			$table->timestamp('last_login')->nullable();
			$table->string('persist_code')->nullable();
			$table->string('reset_password_code')->nullable();
			$table->timestamps();

			$table->engine = 'InnoDB';
			$table->unique('Email');
			$table->index('activation_code');
			$table->index('reset_password_code');
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
        Schema::drop('ProviderCredentials');
        */
    }

}
