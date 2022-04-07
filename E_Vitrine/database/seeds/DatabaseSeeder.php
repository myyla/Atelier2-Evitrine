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
        DB::table('users')->insert([
            'name' => "Amal",
            'email' => 'amaluth29@gmail.com',
            'password' => Hash::make('password'),
        ]);
        // $this->call(UserSeeder::class);
    }
}
