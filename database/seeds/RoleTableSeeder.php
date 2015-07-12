<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        \DB::table('roles')->insert(array(
            [
                'role' => 'System Administrator',
                'description' => '',
            ],
            [
                'role' => 'Manager Approval',
                'description' => '',
            ],
            [
                'role' => 'Finance Approval',
                'description' => '',
            ],
            [
                'role' => 'Printing License',
                'description' => '',
            ],
        ));
    }

}
