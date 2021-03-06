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
        $user = App\User::create([
          'name' => 'Eskindir',
          'email' => 'eskindir_ae@yahoo.com',
          'role_id' => 1,
          'password' => bcrypt('password')
        ]);
    }
}
