<?php

use Illuminate\Database\Seeder;
use App\Role;


class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Role::truncate();
		
		Role::firstOrCreate(['name' => 'admin']);
		Role::firstOrCreate(['name' => 'superuser']);
		Role::firstOrCreate(['name' => 'user']);
    }
}
