<?php

class AdvertisingLevelsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		//DB::table('AdvertisingLevels')->truncate();

		$advertisinglevels = array(
            array(
                'Name'  => 'Free - Included Offer',
                'Price' => 0.0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                'Name'  => 'Nationwide Offer of the Day - $99.99/day',
                'Price' => 99.99,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ),
            array(
                'Name'  => 'Featured Deal of the Day - $19.99/day',
                'Price' => 19.99,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ),
		);

		// Uncomment the below to run the seeder
		//DB::table('AdvertisingLevels')->insert($advertisinglevels);
	}

}
