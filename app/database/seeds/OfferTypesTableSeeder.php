<?php

class OfferTypesTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		//DB::table('OfferTypes')->truncate();

		$offertypes = array(
            array(
                'Title'     => 'Products For In Store Redemption',
                'FinePrint' => 'Limit 1 per pet parent. Limit 1 per visit. Valid only for option purchased. In-store only. Not valid for sale items.',
                'RedeemStep'=> 'by purchasing this and showing proof of purchase (email receipt) at business location, your order is complete',
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ),
            array(
                'Title'     => 'Products Requiring Shipping',
                'FinePrint' => 'Limit 1 per pet parent, may buy 2 more as gifts. Free Returns. Free Shipping. Does not ship to AK/HI/Canada/Pueto Rico. Most orders are delivered within 2 1/2 weeks from purchase date. Does not ship to P.O. Boxes. Must pay applicable tax and provide name and shipping address at checkout, which will be shared with facilities shipping. Goods sold by Service Provider listed.',
                'RedeemStep'=> 'by purchasing this and providing your name and shipping address on checkout, your order is complete',
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ),
            array(
                'Title'     => 'In Home Pet Services',
                'FinePrint' => 'Limit 1 per pet parent, may buy 1 additional as gift. Limit 1 per visit. Valid only for option purchased. Reservation / Appointment required; subject to availability. 24hr cancellation notice required or fee up to PetPaws price may apply. Must sign waiver. Dogs must be up to date on their vaccinations. Must provide a copy of shot record at appointment. Valid only within select service areas.',
                'RedeemStep'=> 'by purchasing this, your order is complete. You will be requested to demonstrate proof of purchase (Email receipt confirmation number) prior to scheduling the service',
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ),
            array(
                'Title'     => 'At Business Pet Services',
                'FinePrint' => 'Limit 1 per pet parent, may buy 1 additional as gift. Limit 1 per visit. Valid only for option purchased. Reservation / Appointment required; subject to availability. 24hr cancellation notice required or fee up to PetPaws price may apply. Must sign waiver. Dogs must be up to date on their vaccinations. Must provide a copy of shot record at appointment.',
                'RedeemStep'=> 'How to redeem: by purchasing this, your order is complete. You will be requested to demonstrate proof of purchase (Email receipt confirmation number) prior to scheduling the service',
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ),
		);

		// Uncomment the below to run the seeder
		//DB::table('OfferTypes')->insert($offertypes);
	}

}
