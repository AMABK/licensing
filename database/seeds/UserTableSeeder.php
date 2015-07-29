<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        \DB::table('users')->insert([
            'first_name' => 'System',
            'last_name' => 'Admin',
            'designation_id' => 1,
            'national_id' => '0000000',
            'phone_no' => '254700000000',
            'email' => 'admin@prisk.co.ke',
            'job_id' => 'Admin',
            'status' => 1,
            'password' => Hash::make('secret@prisk'),
        ]);
    }

}
