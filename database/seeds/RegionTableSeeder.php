<?php

use Illuminate\Database\Seeder;

class RegionTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        \DB::table('regions')->insert(array(
            [
                'name' => 'Nairobi',
            ],
            [
                'name' => 'Central',
            ]
        ));
    }

}
