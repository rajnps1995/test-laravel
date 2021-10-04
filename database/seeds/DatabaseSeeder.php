<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);

        App\User::create([
		    'full_name' => 'Super Admin',
		    'username' => 'applocumadmin@yopmail.com',
		    'password' => \Illuminate\Support\Facades\Hash::make('password@123'),
		    'user_role' => 1
	    ]);

        App\User::create([
		    'full_name' => 'Admin',
		    'username' => 'admin@gmail.com',
		    'password' => \Illuminate\Support\Facades\Hash::make('admin@123'),
		    'user_role' => 2
	    ]);


        App\User::create([
		    'full_name' => 'User',
		    'username' => 'user@gmail.com',
		    'password' => \Illuminate\Support\Facades\Hash::make('user@123'),
		    'user_role' => 3
	    ]);



    }
}
