<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		Schema::disableForeignKeyConstraints();
        User::truncate();
		DB::table('role_user')->truncate();
		Schema::enableForeignKeyConstraints();
		
		$adminRole = Role::where('name', 'admin')->first();
		$superuserRole = Role::where('name', 'superuser')->first();
		$userRole = Role::where('name', 'user')->first();
		
		$admin = User::create([
			'name' => 'Admin GW',
			'email' => 'georg.winter@energiepool.at',
			'password' => Hash::make('cs4y'),
		]);		
		
		$superuser = User::create([
			'name' => 'Superuser Test',
			'email' => 'engelbert.stromeister@gmx.net',
			'password' => Hash::make('cs4y'),
		]);		
		
		$user = User::create([
			'name' => 'User Test',
			'email' => 'angela.currentino@web.de',
			'password' => Hash::make('cs4y'),
		]);
		
		$admin->roles()->attach($adminRole);
		$superuser->roles()->attach($superuserRole);
		$user->roles()->attach($userRole);
    }
}
