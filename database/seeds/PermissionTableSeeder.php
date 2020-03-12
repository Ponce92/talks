<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            'cs_name'=>'puede_ver_permisos',
            'cs_desc'=>'----',
            'cb_activo'=>true,
            'cd_created_at'=>Date::now(),
            'cd_updated_at'=>Date::now(),

        ]);


        DB::table('permissions')->insert([
            'cs_name'=>'puede_crear_permisos',
            'cs_desc'=>'----',
            'cb_activo'=>true,
            'cd_created_at'=>Date::now(),
            'cd_updated_at'=>Date::now(),

        ]);
        DB::table('permissions')->insert([
            'cs_name'=>'puede_asignar_permisos',
            'cs_desc'=>'----',
            'cb_activo'=>true,
            'cd_created_at'=>Date::now(),
            'cd_updated_at'=>Date::now(),

        ]);

        DB::table('roles')->insert([
            'cs_name'=>'puede_ver_roles',
            'cs_desc'=>'----',
            'cb_activo'=>true,
            'cd_created_at'=>Date::now(),
            'cd_updated_at'=>Date::now(),

        ]);


        DB::table('permission_rol')->insert([
            'rol_id'=>1,
            'permission_id'=>1
        ]);
        DB::table('permission_rol')->insert([
            'rol_id'=>1,
            'permission_id'=>2
        ]);
        DB::table('permission_rol')->insert([
            'rol_id'=>1,
            'permission_id'=>3
        ]);
    }
}
