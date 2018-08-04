<?php

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
        $role1 = App\Role::create([
          'name'=>'Administrator',
          'description'=>'Administers data'
        ]);

        $role2 = App\Role::create([
          'name'=>'Student',
          'description'=>'Accesses Resources'
        ]);

        $role3 = App\Role::create([
          'name'=>'Teacher',
          'description'=>'Shares Resources'
        ]);
    }
}
