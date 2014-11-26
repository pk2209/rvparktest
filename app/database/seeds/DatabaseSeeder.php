<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		//$this->call('UserTableSeeder');
		$this->call('SentryTableSeeder');
		//$this->call('OfferTypesTableSeeder');
		//$this->call('AdvertisingLevelsTableSeeder');
		//$this->call('SubscriptionLevelsTableSeeder');
		$this->call('ProviderDomainsTableSeeder');
        //$this->call('ServicesTableSeeder');
		//$this->call('ZipcodeTableSeeder');
	}

}
