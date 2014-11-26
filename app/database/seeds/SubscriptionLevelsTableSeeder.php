<?php

class SubscriptionLevelsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		//DB::table('SubscriptionLevels')->truncate();

		$subscriptionlevels = array(
            array(
                'Description'   => 'Listing Only',
                'Price'         => 0.00,
                'Offers'        => 0,
                'MarketReach'   => 0.0,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s')
            ),
            array(
                'Description'   => '$49.99 - 2 FREE Offer/Month',
                'Price'         => 49.99,
                'Offers'        => 2,
                'MarketReach'   => 0.25,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s')
            ),
            array(
                'Description'   => '$99.99 - 4 FREE Offer/Month',
                'Price'         => 99.99,
                'Offers'        => 4,
                'MarketReach'   => 0.50,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s')
            ),
            array(
                'Description'   => '$149.99 - 10 FREE Offer/Month',
                'Price'         => 149.99,
                'Offers'        => 10,
                'MarketReach'   => 1.0,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s')
            )
		);

		// Uncomment the below to run the seeder
		//DB::table('SubscriptionLevels')->insert($subscriptionlevels);
	}

}
