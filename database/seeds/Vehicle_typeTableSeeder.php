<?php

use Illuminate\Database\Seeder;

class Vehicle_typeTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        \DB::table('vehicle_types')->insert(array(
            [
                'name' => 'Taxi',
                'group' => NULL,
                'description' => 'Does not belong to any group'
            ],
            [
                'name' => 'Matatu',
                'group' => 'Matatu Sacco',
                'description' => ''
            ],
            [
                'name' => 'Bus',
                'group' => 'Bus Company',
                'description' => ''
            ],
            [
                'name' => 'Taxi',
                'group' => 'Taxi Company',
                'description' => ''
            ],
            [
                'name' => 'Company vehicle',
                'group' => 'Company vehicle',
                'description' => ''
            ],
            [
                'name' => 'Tour van',
                'group' => 'Tour Company',
                'description' => ''
            ]
        ));
    }

}
