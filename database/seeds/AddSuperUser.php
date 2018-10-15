<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class AddSuperUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //remove exisiting one
        DB::table('users')->where('email', '=', 'admin@digitalme.com')->delete();
        DB::table('users')->insert([
            'name' => 'Administrator',
            'email' => 'admin@digitalme.com',
            'password' => bcrypt('12345'),
            'user_type' => 'Staff',
            'role_id' => 1
        ]);
    }
}
