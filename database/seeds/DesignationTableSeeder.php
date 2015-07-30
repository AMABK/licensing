<?php

use Illuminate\Database\Seeder;

class DesignationTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        \DB::table('designations')->insert(array(
            [
                'name' => 'System Admin'
            ],
            [
                'name' => 'Managerial'
            ],
            [
                'name' => 'Officer'
            ]
        ));
    }

}
