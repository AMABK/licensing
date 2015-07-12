<?php

use Illuminate\Database\Seeder;

class AgentTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        \DB::table('agents')->insert(array(
            [
                'name' => 'Defaul Agent',
                'phone_no' => '254728258655',
                'region_id' => 1,
                'postal_address' => '7920 -00400',
            ]
        ));
    }

}
