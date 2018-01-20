<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'Admin',
			'name' => 'Shipsoftware',
            'email' => 'admin@shipsoftware.local',
            'password' => bcrypt('secret'),
        ]);
    }
}
