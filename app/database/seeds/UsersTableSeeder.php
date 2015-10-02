<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
		User::create([
                'username'   => 'cooper',
                'password'   => Hash::make('welcome'),
                'mobile'     => '18888888888',
                'grade'      => '1',
                'disable'    => '0',
                'created_at' => new DateTime,
            ]);
	}
}
