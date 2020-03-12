<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'cs_name'=>'Azael',
            'email'=>'',
            'password'=>Hash::make('azael'),
            'cb_state'=>true,
            'cb_protected'=>true,
            'rol_id'=>1
        ]);

        DB::table('users')->insert([
            'cs_name'=>'User1',
            'email'=>'',
            'password'=>Hash::make('user1'),
            'cb_state'=>true,
            'cb_protected'=>false,
            'rol_id'=>2
        ]);
    }
}
