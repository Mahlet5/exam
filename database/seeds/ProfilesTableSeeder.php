<?php

use Illuminate\Database\Seeder;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profile = App\Profile::create([
          'avatar'=>'uploads/avatars/default.png',
          'user_id'=>1,
          'phone'=>'(+251) 913 011 296'
        ]);
    }
}
