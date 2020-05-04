<?php

use Illuminate\Database\Seeder;

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
            'cd_created_at'=>now(),
            'cd_updated_at'=>now(),
            'cs_group'=>'Permisos',
        ]);
        DB::table('permissions')->insert([
            'cs_name'=>'puede_crear_permisos',
            'cs_desc'=>'----',
            'cb_activo'=>true,
            'cd_created_at'=>now(),
            'cd_updated_at'=>now(),
            'cs_group'=>'Permisos'

        ]);
        DB::table('permissions')->insert([
            'cs_name'=>'puede_asignar_permisos',
            'cs_desc'=>'----',
            'cb_activo'=>true,
            'cd_created_at'=>now(),
            'cd_updated_at'=>now(),
            'cs_group'=>'Permisos',

        ]);

        DB::table('permissions')->insert([
            'cs_name'=>'puede_ver_roles',
            'cs_desc'=>'----',
            'cb_activo'=>true,
            'cd_created_at'=>now(),
            'cd_updated_at'=>now(),
            'cs_group'=>'roles',
        ]);
        DB::table('permissions')->insert([
            'cs_name'=>'puede_crear_roles',
            'cs_desc'=>'----',
            'cb_activo'=>true,
            'cd_created_at'=>now(),
            'cd_updated_at'=>now(),
            'cs_group'=>'roles',
        ]);
        DB::table('permissions')->insert([
            'cs_name'=>'puede_eliminar_roles',
            'cs_desc'=>'----',
            'cb_activo'=>true,
            'cd_created_at'=>now(),
            'cd_updated_at'=>now(),
            'cs_group'=>'roles',
        ]);


        DB::table('permissions')->insert([
            'cs_name'=>'puede_ver_cargos',
            'cs_desc'=>'----',
            'cb_activo'=>true,
            'cd_created_at'=>now(),
            'cd_updated_at'=>now(),
            'cs_group'=>'cargos',
        ]);
        DB::table('permissions')->insert([
            'cs_name'=>'puede_crear_cargos',
            'cs_desc'=>'----',
            'cb_activo'=>true,
            'cd_created_at'=>now(),
            'cd_updated_at'=>now(),
            'cs_group'=>'cargos',

        ]);
        DB::table('permissions')->insert([
            'cs_name'=>'puede_eliminar_cargos',
            'cs_desc'=>'----',
            'cb_activo'=>true,
            'cd_created_at'=>now(),
            'cd_updated_at'=>now(),
            'cs_group'=>'cargos',

        ]);

        DB::table('permissions')->insert([
            'cs_name'=>'puede_ver_departamentos',
            'cs_desc'=>'----',
            'cb_activo'=>true,
            'cd_created_at'=>now(),
            'cd_updated_at'=>now(),
            'cs_group'=>'Departamentos',
        ]);
        DB::table('permissions')->insert([
            'cs_name'=>'puede_crear_departamentos',
            'cs_desc'=>'----',
            'cb_activo'=>true,
            'cd_created_at'=>now(),
            'cd_updated_at'=>now(),
            'cs_group'=>'Departamentos',
        ]);
        DB::table('permissions')->insert([
            'cs_name'=>'puede_eliminar_departamentos',
            'cs_desc'=>'----',
            'cb_activo'=>true,
            'cd_created_at'=>now(),
            'cd_updated_at'=>now(),
            'cs_group'=>'Departamentos',
        ]);

        DB::table('permissions')->insert([
            'cs_name'=>'puede_ver_plazas',
            'cs_desc'=>'----',
            'cb_activo'=>true,
            'cd_created_at'=>now(),
            'cd_updated_at'=>now(),
            'cs_group'=>'Plazas',
        ]);
        DB::table('permissions')->insert([
            'cs_name'=>'puede_crear_plazas',
            'cs_desc'=>'----',
            'cb_activo'=>true,
            'cd_created_at'=>now(),
            'cd_updated_at'=>now(),
            'cs_group'=>'Plazas',
        ]);
        DB::table('permissions')->insert([
            'cs_name'=>'puede_eliminar_plazas',
            'cs_desc'=>'----',
            'cb_activo'=>true,
            'cd_created_at'=>now(),
            'cd_updated_at'=>now(),
            'cs_group'=>'Plazas',
        ]);

        DB::table('permissions')->insert([
            'cs_name'=>'puede_editar_departamentos',
            'cs_desc'=>'----',
            'cb_activo'=>true,
            'cd_created_at'=>now(),
            'cd_updated_at'=>now(),
            'cs_group'=>'Departamento',
        ]);

//Role_permission table. . ..........................

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

        DB::table('permission_rol')->insert([
            'rol_id'=>2,
            'permission_id'=>4
        ]);
        DB::table('permission_rol')->insert([
            'rol_id'=>2,
            'permission_id'=>5
        ]);
        DB::table('permission_rol')->insert([
            'rol_id'=>2,
            'permission_id'=>6
        ]);
        DB::table('permission_rol')->insert([
            'rol_id'=>2,
            'permission_id'=>4
        ]);
        DB::table('permission_rol')->insert([
            'rol_id'=>2,
            'permission_id'=>7
        ]);
        DB::table('permission_rol')->insert([
            'rol_id'=>2,
            'permission_id'=>8
        ]);
        DB::table('permission_rol')->insert([
            'rol_id'=>2,
            'permission_id'=>9
        ]);

        DB::table('permission_rol')->insert([
            'rol_id'=>2,
            'permission_id'=>10
        ]);
        DB::table('permission_rol')->insert([
            'rol_id'=>2,
            'permission_id'=>11
        ]);
        DB::table('permission_rol')->insert([
            'rol_id'=>2,
            'permission_id'=>12
        ]);
        DB::table('permission_rol')->insert([
            'rol_id'=>2,
            'permission_id'=>13
        ]);
        DB::table('permission_rol')->insert([
            'rol_id'=>2,
            'permission_id'=>14
        ]);
        DB::table('permission_rol')->insert([
            'rol_id'=>2,
            'permission_id'=>15
        ]);
        DB::table('permission_rol')->insert([
            'rol_id'=>2,
            'permission_id'=>16
        ]);

    }
}
