<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name'=> 'admin']);
        Role::create(['name'=> 'Dispatcher']);
        Role::create(['name'=> 'Driver']);
        Role::create(['name'=> 'Passenger']);
    }
}
