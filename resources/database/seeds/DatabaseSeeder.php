<?php

use Illuminate\Database\Seeder;



class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('super_admins')->insert([
            'id' => 1,
            'First_Name' => 'Mukesh',
            'Last_Name' => 'Bhandari',
            'email' => 'gmukeshbhandari@gmail.com',
            'password' => bcrypt('123456789m'),
        ]);


        DB::table('admins')->insert([
            'id' => 1,
            'College_Name' => 'Kathford International College of Engineering and Management',
            'email' => 'kathford@oe.com',
            'password' => bcrypt('123456789k'),
            'Country' => 'Nepal',
            'Zone' => 'Bagmati',
            'District' => 'Lalitpur',
            'Province_No' => 3,
            'Street_Address' => 'Balkumari',
            'College_ID' => 1,
            'Last_College_Name_Update' => date('Y-m-d h:m:s'),
            'Last_Password_Update'  => date('Y-m-d h:m:s'),
            'Verified' => 1,
        ]);

        DB::table('login_details')->insert([
            'id' => 1,
            'email' => 'kathford@oe.com',
            'IP_Address' => \Request::ip(),
            'Login_DateandTime' => date('Y-m-d h:m:s'),
            'Login_Type' => 'Account Creation',
            'User_Type' => 'admin',

        ]);

        DB::table('admins')->insert([
            'id' => 2,
            'College_Name' => 'Ambition College',
            'email' => 'ambition@oe.com',
            'password' => bcrypt('123456789a'),
            'Country' => 'Nepal',
            'Zone' => 'Bagmati',
            'District' => 'Kathmandu',
            'Province_No' => 3,
            'Street_Address' => 'Mid-Baneshwor',
            'College_ID' => 2,
            'Last_College_Name_Update' => date('Y-m-d h:m:s'),
            'Last_Password_Update'  => date('Y-m-d h:m:s'),
            'Verified' => 1,
        ]);

        DB::table('login_details')->insert([
            'id' => 2,
            'email' => 'ambition@oe.com',
            'IP_Address' => \Request::ip(),
            'Login_DateandTime' => date('Y-m-d h:m:s'),
            'Login_Type' => 'Account Creation',
            'User_Type' => 'admin',

        ]);

        DB::table('admins')->insert([
            'id' => 3,
            'College_Name' => 'St. Lawrence College',
            'email' => 'stlawrence@oe.com',
            'password' => bcrypt('123456789s'),
            'Country' => 'Nepal',
            'Zone' => 'Bagmati',
            'District' => 'Kathmandu',
            'Province_No' => 3,
            'Street_Address' => 'Chabahil',
            'College_ID' => 3,
            'Last_College_Name_Update' => date('Y-m-d h:m:s'),
            'Last_Password_Update'  => date('Y-m-d h:m:s'),
            'Verified' => 1,
        ]);

        DB::table('login_details')->insert([
            'id' => 3,
            'email' => 'stlawrence@oe.com',
            'IP_Address' => \Request::ip(),
            'Login_DateandTime' => date('Y-m-d h:m:s'),
            'Login_Type' => 'Account Creation',
            'User_Type' => 'admin',

        ]);

        DB::table('admins')->insert([
            'id' => 4,
            'College_Name' => 'Arunima College',
            'email' => 'arunima@oe.com',
            'password' => bcrypt('123456789a'),
            'Country' => 'Nepal',
            'Zone' => 'Bagmati',
            'District' => 'Kathmandu',
            'Province_No' => 3,
            'Street_Address' => 'Kumarigal',
            'College_ID' => 4,
            'Last_College_Name_Update' => date('Y-m-d h:m:s'),
            'Last_Password_Update'  => date('Y-m-d h:m:s'),
            'Verified' => 1,
        ]);

        DB::table('login_details')->insert([
            'id' => 4,
            'email' => 'arunima@oe.com',
            'IP_Address' => \Request::ip(),
            'Login_DateandTime' => date('Y-m-d h:m:s'),
            'Login_Type' => 'Account Creation',
            'User_Type' => 'admin',

        ]);


        DB::table('users')->insert([
            'id' => 1,
            'First_Name' => 'Mukesh',
            'Last_Name' => 'Bhandari',
            'email' => 'mukesh@oe.com',
            'password' => bcrypt('123456789m'),
            'Gender'  => 'Male',
            'Country' => 'Nepal',
            'College_ID' => 1,
            'Symbol_No' => '11111111',
            'Zone' => 'Bagmati',
            'District' => 'Kathmandu',
            'Village' => 'Jorpati',
            'Province_No' => 3,
            'Street_Address' => 'Aarubari',
            'Ward_No' => 8,
            'Last_First_Name_Update' => date('Y-m-d h:m:s'),
            'Last_Middle_Name_Update' => date('Y-m-d h:m:s'),
            'Last_Last_Name_Update' => date('Y-m-d h:m:s'),
            'Last_Password_Update'  => date('Y-m-d h:m:s'),
            'Verified' => 1,
        ]);

        DB::table('login_details')->insert([
            'id' => 5,
            'email' => 'mukesh@oe.com',
            'IP_Address' => \Request::ip(),
            'Login_DateandTime' => date('Y-m-d h:m:s'),
            'Login_Type' => 'Account Creation',
            'User_Type' => 'user',

        ]);

        DB::table('users')->insert([
            'id' => 2,
            'First_Name' => 'Sushant',
            'Middle_Name' => 'Jung',
            'Last_Name' => 'Thapa',
            'email' => 'sushant@oe.com',
            'password' => bcrypt('123456789s'),
            'Gender'  => 'Male',
            'Country' => 'Nepal',
            'College_ID' => 1,
            'Symbol_No' => '11111112',
            'Zone' => 'Bagmati',
            'District' => 'Kathmandu',
            'Village' => 'Mulpani',
            'Province_No' => 3,
            'Last_First_Name_Update' => date('Y-m-d h:m:s'),
            'Last_Middle_Name_Update' => date('Y-m-d h:m:s'),
            'Last_Last_Name_Update' => date('Y-m-d h:m:s'),
            'Last_Password_Update'  => date('Y-m-d h:m:s'),
            'Verified' => 1,
        ]);

        DB::table('login_details')->insert([
            'id' => 6,
            'email' => 'sushant@oe.com',
            'IP_Address' => \Request::ip(),
            'Login_DateandTime' => date('Y-m-d h:m:s'),
            'Login_Type' => 'Account Creation',
            'User_Type' => 'user',

        ]);

        DB::table('users')->insert([
            'id' => 3,
            'First_Name' => 'Shubham',
            'Last_Name' => 'Poudel',
            'email' => 'shubham@oe.com',
            'password' => bcrypt('123456789s'),
            'Gender'  => 'Male',
            'Country' => 'Nepal',
            'College_ID' => 2,
            'Symbol_No' => '11111211',
            'Zone' => 'Koshi',
            'District' => 'Morang',
            'Village' => 'Biratnagar Sub Metro-city',
            'Province_No' => 1,
            'Ward_No' => 1,
            'Last_First_Name_Update' => date('Y-m-d h:m:s'),
            'Last_Middle_Name_Update' => date('Y-m-d h:m:s'),
            'Last_Last_Name_Update' => date('Y-m-d h:m:s'),
            'Last_Password_Update'  => date('Y-m-d h:m:s'),
            'Verified' => 1,
        ]);

        DB::table('login_details')->insert([
            'id' => 7,
            'email' => 'shubham@oe.com',
            'IP_Address' => \Request::ip(),
            'Login_DateandTime' => date('Y-m-d h:m:s'),
            'Login_Type' => 'Account Creation',
            'User_Type' => 'user',

        ]);

        DB::table('users')->insert([
        'id' => 4,
        'First_Name' => 'Bikash',
        'Last_Name' => 'Adhikari',
        'email' => 'bikash@oe.com',
        'password' => bcrypt('123456789b'),
        'Gender'  => 'Male',
        'Country' => 'Nepal',
        'College_ID' => 2,
        'Symbol_No' => '11111212',
        'Last_First_Name_Update' => date('Y-m-d h:m:s'),
        'Last_Middle_Name_Update' => date('Y-m-d h:m:s'),
        'Last_Last_Name_Update' => date('Y-m-d h:m:s'),
        'Last_Password_Update'  => date('Y-m-d h:m:s'),
        'Verified' => 1,
    ]);

        DB::table('login_details')->insert([
            'id' => 8,
            'email' => 'bikash@oe.com',
            'IP_Address' => \Request::ip(),
            'Login_DateandTime' => date('Y-m-d h:m:s'),
            'Login_Type' => 'Account Creation',
            'User_Type' => 'user',

        ]);

        DB::table('users')->insert([
        'id' => 5,
        'First_Name' => 'Milan',
        'Last_Name' => 'Bista',
        'email' => 'milan@oe.com',
        'password' => bcrypt('123456789m'),
        'Gender'  => 'Male',
        'Country' => 'Nepal',
        'College_ID' => 3,
        'Symbol_No' => '11111311',
        'Last_First_Name_Update' => date('Y-m-d h:m:s'),
        'Last_Middle_Name_Update' => date('Y-m-d h:m:s'),
        'Last_Last_Name_Update' => date('Y-m-d h:m:s'),
        'Last_Password_Update'  => date('Y-m-d h:m:s'),
        'Verified' => 1,
    ]);

        DB::table('login_details')->insert([
            'id' => 9,
            'email' => 'milan@oe.com',
            'IP_Address' => \Request::ip(),
            'Login_DateandTime' => date('Y-m-d h:m:s'),
            'Login_Type' => 'Account Creation',
            'User_Type' => 'user',

        ]);

        DB::table('users')->insert([
        'id' => 6,
        'First_Name' => 'Hari',
        'Last_Name' => 'Chapagain',
        'email' => 'hari@oe.com',
        'password' => bcrypt('123456789h'),
        'Gender'  => 'Male',
        'Country' => 'Nepal',
        'College_ID' => 3,
        'Symbol_No' => '11111312',
        'Last_First_Name_Update' => date('Y-m-d h:m:s'),
        'Last_Middle_Name_Update' => date('Y-m-d h:m:s'),
        'Last_Last_Name_Update' => date('Y-m-d h:m:s'),
        'Last_Password_Update'  => date('Y-m-d h:m:s'),
        'Verified' => 1,
    ]);

        DB::table('login_details')->insert([
            'id' => 10,
            'email' => 'hari@oe.com',
            'IP_Address' => \Request::ip(),
            'Login_DateandTime' => date('Y-m-d h:m:s'),
            'Login_Type' => 'Account Creation',
            'User_Type' => 'user',

        ]);



    }
}
