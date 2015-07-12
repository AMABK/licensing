<?php

use Illuminate\Database\Seeder;

class ChargeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('charges')->insert(array(
            [
                'type_id' => 1,
                'standard_fee' => 2000,
                'extra_fee' => 0,
                'standard_seats' => 6,
                'description' => '',
                'user_id' => ''
            ],
            [
                'type_id' => 2,
                'standard_fee' => 6000,
                'extra_fee' => 0,
                'standard_seats' => 14,
                'description' => '',
                'user_id' => ''
            ],
            [
                'type_id' => 3,
                'standard_fee' => 0,
                'extra_fee' => 200,
                'standard_seats' => 60,
                'description' => '',
                'user_id' => ''
            ],
            [
                'type_id' => 4,
                'standard_fee' => 2000,
                'extra_fee' => 0,
                'standard_seats' => 6,
                'description' => '',
                'user_id' => ''
            ],
            [
                'type_id' => 5,
                'standard_fee' => 2000,
                'extra_fee' => 200,
                'standard_seats' => 14,
                'description' => '',
                'user_id' => ''
            ],
            [
                'type_id' => 6,
                'standard_fee' => 2000,
                'extra_fee' => 200,
                'standard_seats' => 14,
                'description' => '',
                'user_id' => ''
            ]
            
        ));
    }
}
