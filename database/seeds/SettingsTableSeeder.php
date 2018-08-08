<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = App\Setting::create([
          'site_name'=>'Exam Management',
          'contact_number'=>'(+251) 111 11 11 11',
          'contact_email'=>'4kexam@support.com',
          'address'=>'Addis Ababa, Ethiopia',
          'logo'=>'uploads/company/logo.png',
          'about'=>'Its about something'
        ]);
    }
}
