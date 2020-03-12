<?php

use Illuminate\Database\Seeder;

class RolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'cs_name'=>'Administrador IT',
            'cb_state'=>true,
            'cb_protected'=>true,
            'cs_desc'=>'Rol administrador del sistema',
        ]);

        DB::table('roles')->insert([
            'cs_name'=>'Administrador',
            'cb_state'=>true,
            'cb_protected'=>false,
            'cs_desc'=>'Rol administrador del sistema',
        ]);
    }
}
