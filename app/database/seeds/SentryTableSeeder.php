<?php

class SentryTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('petpaws.users')->truncate();
        DB::table('ProviderCredentials')->truncate();

		Sentry::getUserProvider()->create(array(
            'Email'       => 'admin@petpa.ws',
            'UserName'    => '',
            'CompanyName' => 'Pet Paws',
            'FirstName'   => 'PetPaws',
            'LastName'    => 'Admin',
            'Hash'        => Crypt::encrypt('password'),
            'password'    => 'password',
            'activated'   => 1,
            'permissions' => array(
                'admin'     => 1,
                'dashboard' => 1,
                'superuser' => 1
            )
        ));

		// Uncomment the below to run the seeder
		//DB::table('sentry')->insert($sentry);
		//DB::table('petpaws.users')->insert($sentry);
	}

}
