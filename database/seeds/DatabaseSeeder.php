<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

         $this->call('UserTableSeeder');
         $this->call('Vehicle_typeTableSeeder');
         $this->call('AgentTableSeeder');
         $this->call('ChargeTableSeeder');
         $this->call('RegionTableSeeder');
         $this->call('RoleTableSeeder');
         $this->call('DesignationTableSeeder');

        Model::reguard();
    }
}
