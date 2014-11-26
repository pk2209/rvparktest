<?php

class ProviderDomainsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('petpaws.ProviderDomains')->truncate();

		$providerdomains = array(
            array(
                'Name'      => 'petpa.ws'
                //'created_at'=> date('Y-m-d H:i:s'),
                //'updated_at'=> date('Y-m-d H:i:s')
            )
		);

		// Uncomment the below to run the seeder
		DB::table('petpaws.ProviderDomains')->insert($providerdomains);
	}

}
