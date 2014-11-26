<?php

class ServicesTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		//DB::table('Services')->truncate();

		$services = array(
            array(
                'Name'      => 'Veterinarian', 
                'ParentID'  => 0,
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ),
            array(
                'Name'      => 'Pharmacy', 
                'ParentID'  => 0,
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ),
            array(
                'Name'      => 'Groomer', 
                'ParentID'  => 0,
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ),
            array(
                'Name'      => 'Boarder', 
                'ParentID'  => 0,
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ),
            array(
                'Name'      => 'Walker', 
                'ParentID'  => 0,
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ),
            array(
                'Name'      => 'Retail', 
                'ParentID'  => 0,
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ),
            array(
                'Name'      => 'Sitter', 
                'ParentID'  => 0,
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            )
		);

		// Uncomment the below to run the seeder
		//DB::table('Services')->insert($services);
	}

}
