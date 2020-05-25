<?php

use Illuminate\Database\Seeder;

class PayrollSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

/*
 * Seeders de las tablas secundarias del modulo payroll
 */
        DB::table('contract_types')->insert([
            'cs_name'=>'Contrato Fijo'
        ]);
        DB::table('contract_types')->insert([
            'cs_name'=>'Servicios profecioales'
        ]);

        DB::table('employee_status')->insert([
            'cs_name'=>'Activo'
        ]);
        DB::table('employee_status')->insert([
            'cs_name'=>'Baja'
        ]);

        DB::table('marital_status')->insert([
            'cs_name'=>'Soltero',
        ]);
        DB::table('marital_status')->insert([
            'cs_name'=>'Casado',
        ]);
        DB::table('marital_status')->insert([
            'cs_name'=>'Acompaniado',
        ]);
        DB::table('marital_status')->insert([
            'cs_name'=>'Divorciado',
        ]);
        DB::table('marital_status')->insert([
            'cs_name'=>'Viudo',
        ]);

        DB::table('parking_types')->insert([
            'cs_name'=>'Moto',
        ]);
        DB::table('parking_types')->insert([
            'cs_name'=>'Vehiculo',
        ]);


        //Referencis de persona ...

        DB::table('relationship_types')->insert([
            'cs_name'=>'Hermano'
        ]);
        DB::table('relationship_types')->insert([
            'cs_name'=>'Padres'
        ]);
        DB::table('relationship_types')->insert([
            'cs_name'=>'Amigo'
        ]);
        DB::table('relationship_types')->insert([
            'cs_name'=>'Conocido'
        ]);
        DB::table('relationship_types')->insert([
        'cs_name'=>'Jefe'
        ]);


        //====================================================
        DB::table('retirement_types')->insert([
            'cs_name'=>'Finalizacion de contrato'
        ]);
        DB::table('retirement_types')->insert([
            'cs_name'=>'Insubordinacion'
        ]);
        DB::table('retirement_types')->insert([
            'cs_name'=>'Renuncia voluntaria'
        ]);
        DB::table('retirement_types')->insert([
            'cs_name'=>'Bajo rendimineto'
        ]);
    }

}
