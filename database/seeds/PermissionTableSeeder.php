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
        //======================================
        //Menu administracion
        //======================================
        DB::table('permissions')->insert([
            'cs_name'=>'menu_administracion',
            'cs_desc'=>'----',
            'cb_activo'=>true,
            'cd_created_at'=>date('y-m-d'),
            'cd_updated_at'=>date('y-m-d'),
            'cs_group'=>'Menus',

        ]);
        //Roles ...
        DB::table('permissions')->insert([
            'cs_name'=>'listar_roles',
            'cs_desc'=>'----',
            'cb_activo'=>true,
            'cd_created_at'=>date('y-m-d'),
            'cd_updated_at'=>date('y-m-d'),
            'cs_group'=>'Roles',

        ]);
        DB::table('permissions')->insert([
            'cs_name'=>'crear_roles',
            'cs_desc'=>'----',
            'cb_activo'=>true,
            'cd_created_at'=>date('y-m-d'),
            'cd_updated_at'=>date('y-m-d'),
            'cs_group'=>'Roles',

        ]);
        DB::table('permissions')->insert([
            'cs_name'=>'editar_roles',
            'cs_desc'=>'----',
            'cb_activo'=>true,
            'cd_created_at'=>date('y-m-d'),
            'cd_updated_at'=>date('y-m-d'),
            'cs_group'=>'Roles',

        ]);
        DB::table('permissions')->insert([
            'cs_name'=>'asignar_permisos_roles',
            'cs_desc'=>'----',
            'cb_activo'=>true,
            'cd_created_at'=>date('y-m-d'),
            'cd_updated_at'=>date('y-m-d'),
            'cs_group'=>'Roles',

        ]);

        //Usuarios . . .
        DB::table('permissions')->insert([
            'cs_name'=>'listar_usuarios',
            'cs_desc'=>'----',
            'cb_activo'=>true,
            'cd_created_at'=>date('y-m-d'),
            'cd_updated_at'=>date('y-m-d'),
            'cs_group'=>'Usuarios',

        ]);
        DB::table('permissions')->insert([
            'cs_name'=>'crear_usuarios',
            'cs_desc'=>'----',
            'cb_activo'=>true,
            'cd_created_at'=>date('y-m-d'),
            'cd_updated_at'=>date('y-m-d'),
            'cs_group'=>'Usuarios',

        ]);
        DB::table('permissions')->insert([
            'cs_name'=>'editar_usuarios',
            'cs_desc'=>'----',
            'cb_activo'=>true,
            'cd_created_at'=>date('y-m-d'),
            'cd_updated_at'=>date('y-m-d'),
            'cs_group'=>'Usuarios',

        ]);
        DB::table('permissions')->insert([
            'cs_name'=>'asignar_permisos_usuarios',
            'cs_desc'=>'----',
            'cb_activo'=>true,
            'cd_created_at'=>date('y-m-d'),
            'cd_updated_at'=>date('y-m-d'),
            'cs_group'=>'Usuarios',

        ]);
        DB::table('permissions')->insert([
            'cs_name'=>'asingar_grupos_usuarios',
            'cs_desc'=>'----',
            'cb_activo'=>true,
            'cd_created_at'=>date('y-m-d'),
            'cd_updated_at'=>date('y-m-d'),
            'cs_group'=>'Usuarios',

        ]);

        //grupos de usuario
        DB::table('permissions')->insert([
            'cs_name'=>'listar_grupos',
            'cs_desc'=>'----',
            'cb_activo'=>true,
            'cd_created_at'=>date('y-m-d'),
            'cd_updated_at'=>date('y-m-d'),
            'cs_group'=>'Grupos de usuario',

        ]);
        DB::table('permissions')->insert([
            'cs_name'=>'crear_grupos',
            'cs_desc'=>'----',
            'cb_activo'=>true,
            'cd_created_at'=>date('y-m-d'),
            'cd_updated_at'=>date('y-m-d'),
            'cs_group'=>'Grupos de usuario',
        ]);
        DB::table('permissions')->insert([
            'cs_name'=>'editar_grupos',
            'cs_desc'=>'----',
            'cb_activo'=>true,
            'cd_created_at'=>date('y-m-d'),
            'cd_updated_at'=>date('y-m-d'),
            'cs_group'=>'Grupos de usuario',
        ]);
        DB::table('permissions')->insert([
            'cs_name'=>'asignar_permisos_grupos',
            'cs_desc'=>'----',
            'cb_activo'=>true,
            'cd_created_at'=>date('y-m-d'),
            'cd_updated_at'=>date('y-m-d'),
            'cs_group'=>'Grupos de usuario',
        ]);


        //======================================
        //Menu planilla
        //======================================

        DB::table('permissions')->insert([
            'cs_name'=>'menu_planilla',
            'cs_desc'=>'----',
            'cb_activo'=>true,
            'cd_created_at'=>date('y-m-d'),
            'cd_updated_at'=>date('y-m-d'),
            'cs_group'=>'Menus',
        ]);

        //Departamentos..
        DB::table('permissions')->insert([
            'cs_name'=>'listar_departamentos',
            'cs_desc'=>'----',
            'cb_activo'=>true,
            'cd_created_at'=>date('y-m-d'),
            'cd_updated_at'=>date('y-m-d'),
            'cs_group'=>'Planilla',
        ]);
        DB::table('permissions')->insert([
            'cs_name'=>'crear_departamentos',
            'cs_desc'=>'----',
            'cb_activo'=>true,
            'cd_created_at'=>date('y-m-d'),
            'cd_updated_at'=>date('y-m-d'),
            'cs_group'=>'Planilla',
        ]);
        DB::table('permissions')->insert([
            'cs_name'=>'editar_departamentos',
            'cs_desc'=>'----',
            'cb_activo'=>true,
            'cd_created_at'=>date('y-m-d'),
            'cd_updated_at'=>date('y-m-d'),
            'cs_group'=>'Planilla',
        ]);
        DB::table('permissions')->insert([
            'cs_name'=>'gestionar_areas',
            'cs_desc'=>'----',
            'cb_activo'=>true,
            'cd_created_at'=>date('y-m-d'),
            'cd_updated_at'=>date('y-m-d'),
            'cs_group'=>'Planilla',
        ]);

        // Puestos de trabajo . . .
        DB::table('permissions')->insert([
            'cs_name'=>'listar_puestos',
            'cs_desc'=>'----',
            'cb_activo'=>true,
            'cd_created_at'=>date('y-m-d'),
            'cd_updated_at'=>date('y-m-d'),
            'cs_group'=>'Planilla',
        ]);
        DB::table('permissions')->insert([
            'cs_name'=>'crear_puestos',
            'cs_desc'=>'----',
            'cb_activo'=>true,
            'cd_created_at'=>date('y-m-d'),
            'cd_updated_at'=>date('y-m-d'),
            'cs_group'=>'Planilla',
        ]);
        DB::table('permissions')->insert([
            'cs_name'=>'editar_puestos',
            'cs_desc'=>'----',
            'cb_activo'=>true,
            'cd_created_at'=>date('y-m-d'),
            'cd_updated_at'=>date('y-m-d'),
            'cs_group'=>'Planilla',
        ]);

        // plazas de trabajo
        DB::table('permissions')->insert([
            'cs_name'=>'listar_plazas',
            'cs_desc'=>'----',
            'cb_activo'=>true,
            'cd_created_at'=>date('y-m-d'),
            'cd_updated_at'=>date('y-m-d'),
            'cs_group'=>'Planilla',
        ]);
        DB::table('permissions')->insert([
            'cs_name'=>'crear_plazas',
            'cs_desc'=>'----',
            'cb_activo'=>true,
            'cd_created_at'=>date('y-m-d'),
            'cd_updated_at'=>date('y-m-d'),
            'cs_group'=>'Planilla',
        ]);
        DB::table('permissions')->insert([
            'cs_name'=>'gestionar_plazas',
            'cs_desc'=>'----',
            'cb_activo'=>true,
            'cd_created_at'=>date('y-m-d'),
            'cd_updated_at'=>date('y-m-d'),
            'cs_group'=>'Planilla',
        ]);

        //..................
        DB::table('permissions')->insert([
            'cs_name'=>'listar_empleados',
            'cs_desc'=>'----',
            'cb_activo'=>true,
            'cd_created_at'=>date('y-m-d'),
            'cd_updated_at'=>date('y-m-d'),
            'cs_group'=>'Planilla',
        ]);
        DB::table('permissions')->insert([
            'cs_name'=>'crear_empleados',
            'cs_desc'=>'----',
            'cb_activo'=>true,
            'cd_created_at'=>date('y-m-d'),
            'cd_updated_at'=>date('y-m-d'),
            'cs_group'=>'Planilla',
        ]);
        DB::table('permissions')->insert([
            'cs_name'=>'gestionar_empleados',
            'cs_desc'=>'----',
            'cb_activo'=>true,
            'cd_created_at'=>date('y-m-d'),
            'cd_updated_at'=>date('y-m-d'),
            'cs_group'=>'Planilla',
        ]);

//Role_permission table. . ..........................

        DB::table('permission_rol')->insert(['rol_id'=>1,'permission_id'=>1]);
        DB::table('permission_rol')->insert(['rol_id'=>1,'permission_id'=>2]);
        DB::table('permission_rol')->insert(['rol_id'=>1,'permission_id'=>3]);
        DB::table('permission_rol')->insert(['rol_id'=>1,'permission_id'=>4]);
        DB::table('permission_rol')->insert(['rol_id'=>1,'permission_id'=>5]);
        DB::table('permission_rol')->insert(['rol_id'=>1,'permission_id'=>6]);
        DB::table('permission_rol')->insert(['rol_id'=>1,'permission_id'=>7]);
        DB::table('permission_rol')->insert(['rol_id'=>1,'permission_id'=>8]);
        DB::table('permission_rol')->insert(['rol_id'=>1,'permission_id'=>9]);
        DB::table('permission_rol')->insert(['rol_id'=>1,'permission_id'=>10]);
        DB::table('permission_rol')->insert(['rol_id'=>1,'permission_id'=>11]);


    }
}
