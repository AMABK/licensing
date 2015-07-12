<?php

use Illuminate\Database\Seeder;

class DesignationTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        \DB::table('designations')->insert([
            'name' => 'System Admin'
        ]);
    }

}
